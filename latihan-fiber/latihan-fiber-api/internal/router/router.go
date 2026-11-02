package router

import (
   "github.com/gofiber/fiber/v3"
   "latihan-fiber-api/internal/config"
   "latihan-fiber-api/internal/handler"
   "latihan-fiber-api/internal/middleware"
)

func Daftarkan(app *fiber.App) {
   konf := config.Muat()

   api := app.Group("/api")

   api.Get("/status", func(c fiber.Ctx) error {
      return c.JSON(fiber.Map{
         "sukses": true,
         "pesan":  "API Fiber aktif",
      })
   })

   mahasiswa := api.Group("/mahasiswa")
   mahasiswa.Get("/nim/:nim", handler.DetailMahasiswaByNim)
   mahasiswa.Get("/", handler.DaftarMahasiswa)
   mahasiswa.Get("/:id", handler.DetailMahasiswa)

   // Tugas 3: Rute terlindungi dengan middleware KunciApi
   rahasia := api.Group("/rahasia", middleware.KunciApi(konf.ApiKey))
   rahasia.Get("/", func(c fiber.Ctx) error {
      return c.JSON(fiber.Map{
         "sukses": true,
         "pesan":  "Akses berhasil: Anda telah terautentikasi dengan X-Api-Key yang valid",
      })
   })
}