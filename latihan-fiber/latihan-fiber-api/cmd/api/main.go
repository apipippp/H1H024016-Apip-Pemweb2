package main

import (
   "errors"
   "log"

   "github.com/gofiber/fiber/v3"
   "github.com/gofiber/fiber/v3/middleware/logger"
   "github.com/gofiber/fiber/v3/middleware/recover"
   "github.com/gofiber/fiber/v3/middleware/requestid"
   "latihan-fiber-api/internal/config"
   "latihan-fiber-api/internal/middleware"
   "latihan-fiber-api/internal/router"
)

// Penangan galat terpusat (Global Error Handler)
func penanganGalat(c fiber.Ctx, err error) error {
   kode := fiber.StatusInternalServerError
   pesan := "Terjadi kesalahan pada server"

   var galatFiber *fiber.Error
   if errors.As(err, &galatFiber) {
      kode = galatFiber.Code
      pesan = galatFiber.Message
   }

   return c.Status(kode).JSON(fiber.Map{
      "sukses": false,
      "pesan":  pesan,
   })
}

func main() {
   konf := config.Muat()

   // Inisialisasi Database, AutoMigrate, dan Seeder Data Awal
   config.HubungkanBasisData(konf)
   config.Migrasi()
   config.DataAwal()

   app := fiber.New(fiber.Config{
      AppName:      konf.NamaAplikasi,
      ErrorHandler: penanganGalat,
   })

   // Middleware global
   app.Use(requestid.New())
   app.Use(logger.New())
   app.Use(recover.New())
   app.Use(middleware.WaktuProses())

   // Daftarkan seluruh rute
   router.Daftarkan(app)

   // Wildcard 404 (penangkap seluruh endpoint yang tidak terdaftar)
   app.Use(func(c fiber.Ctx) error {
      return c.Status(fiber.StatusNotFound).JSON(fiber.Map{
         "sukses": false,
         "pesan":  "Endpoint tidak tersedia",
      })
   })

   log.Println("Server berjalan pada port :" + konf.Port)
   log.Fatal(app.Listen(":" + konf.Port))
}