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

   // Endpoint Program Studi + Jumlah Mahasiswa (Tugas 2 Modul 7)
   api.Get("/program-studi", handler.DaftarProgramStudi)

   // Rute CRUD Mahasiswa
   mahasiswa := api.Group("/mahasiswa")
   mahasiswa.Get("/", handler.DaftarMahasiswa)
   mahasiswa.Post("/", handler.BuatMahasiswa)
   mahasiswa.Get("/:id", handler.DetailMahasiswa)
   mahasiswa.Put("/:id", handler.PerbaruiMahasiswa)
   mahasiswa.Delete("/:id", handler.HapusMahasiswa)
   mahasiswa.Post("/:id/pulihkan", handler.PulihkanMahasiswa) // Tugas 3

   // Rute CRUD Matakuliah (Tugas 1 Modul 7)
   matakuliah := api.Group("/matakuliah")
   matakuliah.Get("/", handler.DaftarMatakuliah)
   matakuliah.Post("/", handler.BuatMatakuliah)
   matakuliah.Get("/:id", handler.DetailMatakuliah)
   matakuliah.Put("/:id", handler.PerbaruiMatakuliah)
   matakuliah.Delete("/:id", handler.HapusMatakuliah)

   // Rute Terproteksi API Key (dari Modul 6)
   rahasia := api.Group("/rahasia", middleware.KunciApi(konf.ApiKey))
   rahasia.Get("/", func(c fiber.Ctx) error {
      return c.JSON(fiber.Map{
         "sukses": true,
         "pesan":  "Akses berhasil: Anda telah terautentikasi dengan X-Api-Key yang valid",
      })
   })
}