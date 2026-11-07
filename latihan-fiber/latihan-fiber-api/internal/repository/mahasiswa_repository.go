package repository

import (
   "latihan-fiber-api/internal/config"
   "latihan-fiber-api/internal/model"
)

type FilterMahasiswa struct {
   Cari       string
   Angkatan   int
   Halaman    int
   PerHalaman int
}

func Ambil(filter FilterMahasiswa) ([]model.Mahasiswa, int64, error) {
   var daftar []model.Mahasiswa
   var total int64
   kueri := config.DB.Model(&model.Mahasiswa{})

   if filter.Cari != "" {
      pola := "%" + filter.Cari + "%"
      kueri = kueri.Where("nama LIKE ? OR nim LIKE ?", pola, pola)
   }
   if filter.Angkatan > 0 {
      kueri = kueri.Where("angkatan = ?", filter.Angkatan)
   }

   err := kueri.Count(&total).Error
   if err != nil {
      return nil, 0, err
   }

   lompat := (filter.Halaman - 1) * filter.PerHalaman
   err = kueri.Preload("ProgramStudi").
      Order("nama ASC").
      Limit(filter.PerHalaman).
      Offset(lompat).
      Find(&daftar).Error

   if err != nil {
      return nil, 0, err
   }

   return daftar, total, nil
}

func AmbilPerId(id uint) (model.Mahasiswa, error) {
   var mahasiswa model.Mahasiswa
   err := config.DB.Preload("ProgramStudi").First(&mahasiswa, id).Error
   return mahasiswa, err
}

func Simpan(mahasiswa *model.Mahasiswa) error {
   return config.DB.Create(mahasiswa).Error
}

func Perbarui(mahasiswa *model.Mahasiswa) error {
   return config.DB.Save(mahasiswa).Error
}

func Hapus(mahasiswa *model.Mahasiswa) error {
   return config.DB.Delete(mahasiswa).Error
}

// Pulihkan data mahasiswa soft delete (Tugas 3)
func Pulihkan(id uint) error {
   var mhs model.Mahasiswa
   if err := config.DB.Unscoped().First(&mhs, id).Error; err != nil {
      return err
   }
   return config.DB.Unscoped().Model(&mhs).Update("deleted_at", nil).Error
}