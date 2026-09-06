package main

import (
	"log"

	"github.com/gofiber/fiber/v3"
)

func main() {
	app := fiber.New()

	// Langkah 6: Endpoint root
	app.Get("/", func(c fiber.Ctx) error {
		return c.SendString("Halo Pemrograman Web II")
	})

	// Langkah 7: Endpoint JSON /api/info
	app.Get("/api/info", func(c fiber.Ctx) error {
		return c.JSON(fiber.Map{
			"aplikasi": "Latihan Fiber",
			"versi":    "1.0.0",
			"status":   "berjalan",
		})
	})

	// Tugas 1: Endpoint GET /api/mahasiswa
	app.Get("/api/mahasiswa", func(c fiber.Ctx) error {
		return c.JSON(fiber.Map{
			"nim":           "H1H024016",
			"nama":          "Afif Nur Rahman",
			"program_studi": "Teknik Komputer",
		})
	})

	log.Fatal(app.Listen(":3000"))
}
