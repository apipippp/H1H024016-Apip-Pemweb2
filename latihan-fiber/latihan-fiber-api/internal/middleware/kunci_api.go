package middleware

import (
   "github.com/gofiber/fiber/v3"
)

// KunciApi memeriksa apakah header X-Api-Key sesuai dengan konfigurasi .env
func KunciApi(kunciBenar string) fiber.Handler {
   return func(c fiber.Ctx) error {
      kunciHeader := c.Get("X-Api-Key")
      if kunciHeader == "" || kunciHeader != kunciBenar {
         return c.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
            "sukses": false,
            "pesan":  "Akses ditolak: API Key tidak valid atau tidak disertakan",
         })
      }
      return c.Next()
   }
}