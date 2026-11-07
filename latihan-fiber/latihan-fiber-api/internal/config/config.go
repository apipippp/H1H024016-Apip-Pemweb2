package config

import (
   "os"

   "github.com/joho/godotenv"
)

type Konfigurasi struct {
   NamaAplikasi string
   Port         string
   Lingkungan   string
   ApiKey       string

   DbHost  string
   DbPort  string
   DbNama  string
   DbUser  string
   DbSandi string
}

func Muat() Konfigurasi {
   godotenv.Load()

   return Konfigurasi{
      NamaAplikasi: ambil("APP_NAME", "Fiber API"),
      Port:         ambil("APP_PORT", "3100"),
      Lingkungan:   ambil("APP_ENV", "local"),
      ApiKey:       ambil("API_KEY", "rahasia-fiber-2026"),

      DbHost:  ambil("DB_HOST", "127.0.0.1"),
      DbPort:  ambil("DB_PORT", "3306"),
      DbNama:  ambil("DB_NAME", "pemweb2_fiber"),
      DbUser:  ambil("DB_USER", "root"),
      DbSandi: ambil("DB_PASS", ""),
   }
}

func ambil(kunci string, bawaan string) string {
   nilai := os.Getenv(kunci)
   if nilai == "" {
      return bawaan
   }
   return nilai
}