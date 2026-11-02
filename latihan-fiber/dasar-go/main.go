package main

import (
   "errors"
   "fmt"
)

// 1. Struct Mahasiswa
type Mahasiswa struct {
   Nim      string
   Nama     string
   Angkatan int
   Ipk      float64
}

// 2. Fungsi pencarian mengembalikan data dan galat (error) jika tidak ada
func cariMahasiswa(daftar []Mahasiswa, nim string) (Mahasiswa, error) {
   for i := 0; i < len(daftar); i++ {
      if daftar[i].Nim == nim {
         return daftar[i], nil
      }
   }
   return Mahasiswa{}, errors.New("mahasiswa tidak ditemukan")
}

// 3. Fungsi menghitung rata-rata IPK
func rerataIpk(daftar []Mahasiswa) float64 {
   if len(daftar) == 0 {
      return 0
   }
   var total float64
   for i := 0; i < len(daftar); i++ {
      total += daftar[i].Ipk
   }
   return total / float64(len(daftar))
}

func main() {
   // Inisialisasi slice struct Mahasiswa
   daftar := []Mahasiswa{
      {Nim: "H1A123001", Nama: "Andi Prasetyo", Angkatan: 2023, Ipk:
3.45},
      {Nim: "H1A123002", Nama: "Bunga Lestari", Angkatan: 2023, Ipk:
3.80},
      {Nim: "H1A124003", Nama: "Citra Ramadhani", Angkatan: 2024, Ipk:
3.20},
   }

   // Uji pencarian
   ditemukan, err := cariMahasiswa(daftar, "H1A123002")
   if err != nil {
      fmt.Println("Galat:", err)
      return
   }
   fmt.Println("Ditemukan:", ditemukan.Nama)
   fmt.Printf("Rerata IPK: %.2f\n", rerataIpk(daftar))

   // Menghitung jumlah per angkatan dengan map
   jumlahPerAngkatan := make(map[int]int)
   for i := 0; i < len(daftar); i++ {
      jumlahPerAngkatan[daftar[i].Angkatan] =
jumlahPerAngkatan[daftar[i].Angkatan] + 1
   }
   fmt.Println("Jumlah per angkatan:", jumlahPerAngkatan)
}