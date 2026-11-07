package repository

import (
   "latihan-fiber-api/internal/config"
   "latihan-fiber-api/internal/model"
)

type FilterMatakuliah struct {
   Cari       string
   Semester   int
   Halaman    int
   PerHalaman int
}

func AmbilMatakuliah(filter FilterMatakuliah) ([]model.Matakuliah, int64, error) {
   var daftar []model.Matakuliah
   var total int64
   kueri := config.DB.Model(&model.Matakuliah{})

   if filter.Cari != "" {
      pola := "%" + filter.Cari + "%"
      kueri = kueri.Where("nama LIKE ? OR kode LIKE ?", pola, pola)
   }
   if filter.Semester > 0 {
      kueri = kueri.Where("semester = ?", filter.Semester)
   }

   err := kueri.Count(&total).Error
   if err != nil {
      return nil, 0, err
   }

   lompat := (filter.Halaman - 1) * filter.PerHalaman
   err = kueri.Order("kode ASC").
      Limit(filter.PerHalaman).
      Offset(lompat).
      Find(&daftar).Error

   return daftar, total, err
}

func AmbilMatakuliahPerId(id uint) (model.Matakuliah, error) {
   var mk model.Matakuliah
   err := config.DB.First(&mk, id).Error
   return mk, err
}

func SimpanMatakuliah(mk *model.Matakuliah) error {
   return config.DB.Create(mk).Error
}

func PerbaruiMatakuliah(mk *model.Matakuliah) error {
   return config.DB.Save(mk).Error
}

func HapusMatakuliah(mk *model.Matakuliah) error {
   return config.DB.Delete(mk).Error
}