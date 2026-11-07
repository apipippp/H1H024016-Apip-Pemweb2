package config

import (
   "log"

   "latihan-fiber-api/internal/model"
)

func Migrasi() {
   err := DB.AutoMigrate(
      &model.ProgramStudi{},
      &model.Mahasiswa{},
			&model.Matakuliah{}, // Modul 7 tugas no 1
   )
   if err != nil {
      log.Fatal("Gagal menjalankan migrasi: ", err)
   }
   log.Println("Migrasi selesai")
}

func DataAwal() {
   var jumlah int64
   DB.Model(&model.ProgramStudi{}).Count(&jumlah)
   if jumlah > 0 {
      return
   }

   daftar := []model.ProgramStudi{
      {Kode: "TK", Nama: "Teknik Komputer", Jenjang: "S1"},
      {Kode: "IF", Nama: "Informatika", Jenjang: "S1"},
      {Kode: "TE", Nama: "Teknik Elektro", Jenjang: "S1"},
   }

   DB.Create(&daftar)
   log.Println("Data awal program studi dibuat")
}