package handler

import (
   "github.com/gofiber/fiber/v3"
   "latihan-fiber-api/internal/config"
   "latihan-fiber-api/internal/model"
)

func DaftarProgramStudi(c fiber.Ctx) error {
   var prodiList []model.ProgramStudi
   if err := config.DB.Find(&prodiList).Error; err != nil {
      return fiber.NewError(fiber.StatusInternalServerError, "Gagal mengambil data program studi")
   }

   var hasil []ResponsProgramStudi
   for _, p := range prodiList {
      var jml int64
      // Menghitung mahasiswa per prodi (otomatis mengabaikan yang berstatus soft-delete)
      config.DB.Model(&model.Mahasiswa{}).Where("program_studi_id = ?", p.ID).Count(&jml)

      hasil = append(hasil, ResponsProgramStudi{
         ID:              p.ID,
         Kode:            p.Kode,
         Nama:            p.Nama,
         Jenjang:         p.Jenjang,
         JumlahMahasiswa: jml,
      })
   }

   return c.JSON(fiber.Map{
      "sukses": true,
      "data":   hasil,
   })
}