package handler

import (
   "strconv"
   "strings"
   "sort"

   "github.com/gofiber/fiber/v3"
   "latihan-fiber-api/internal/model"
)

func DaftarMahasiswa(c fiber.Ctx) error {
   angkatan := c.Query("angkatan", "")
   urut := strings.ToLower(c.Query("urut", ""))

   var hasil []model.Mahasiswa

   // 1. Filter angkatan jika parameter kueri disertakan
   if angkatan != "" {
      nilaiAngkatan, err := strconv.Atoi(angkatan)
      if err != nil {
         return fiber.NewError(fiber.StatusBadRequest, "Parameter angkatan harus berupa angka")
      }

      for i := 0; i < len(model.Daftar); i++ {
         if model.Daftar[i].Angkatan == nilaiAngkatan {
            hasil = append(hasil, model.Daftar[i])
         }
      }
   } else {
      // Salin slice agar pemilahan (sort) tidak merubah urutan pada slice model aslinya
      hasil = make([]model.Mahasiswa, len(model.Daftar))
      copy(hasil, model.Daftar)
   }

   // 2. Logika Pengurutan Tugas 2 (nama atau ipk)
   if urut == "nama" {
      sort.SliceStable(hasil, func(i, j int) bool {
         return hasil[i].Nama < hasil[j].Nama // Urut alfabetis A-Z
      })
   } else if urut == "ipk" {
      sort.SliceStable(hasil, func(i, j int) bool {
         return hasil[i].Ipk > hasil[j].Ipk // Urut IPK tertinggi ke terendah
      })
   }

   return c.JSON(fiber.Map{
      "sukses": true,
      "data":   hasil,
   })
}

func DetailMahasiswa(c fiber.Ctx) error {
   id, err := strconv.Atoi(c.Params("id"))
   if err != nil {
      return fiber.NewError(fiber.StatusBadRequest, "ID harus berupa angka")
   }

   for i := 0; i < len(model.Daftar); i++ {
      if model.Daftar[i].ID == id {
         return c.JSON(fiber.Map{
            "sukses": true,
            "data":   model.Daftar[i],
         })
      }
   }

   return fiber.NewError(fiber.StatusNotFound, "Mahasiswa tidak ditemukan")
}

// DetailMahasiswaByNim menangani Tugas 1: pencarian data mahasiswa berdasarkan NIM
func DetailMahasiswaByNim(c fiber.Ctx) error {
   nim := c.Params("nim")

   for i := 0; i < len(model.Daftar); i++ {
      // Menggunakan EqualFold agar pencarian bersifat case-insensitive
      if strings.EqualFold(model.Daftar[i].Nim, nim) {
         return c.JSON(fiber.Map{
            "sukses": true,
            "data":   model.Daftar[i],
         })
      }
   }

   return fiber.NewError(fiber.StatusNotFound, "Mahasiswa dengan NIM "+nim+" tidak ditemukan")
}