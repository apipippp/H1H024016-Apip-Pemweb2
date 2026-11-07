package handler

type PermintaanMahasiswa struct {
   ProgramStudiID uint    `json:"program_studi_id"`
   Nim            string  `json:"nim"`
   Nama           string  `json:"nama"`
   Email          string  `json:"email"`
   Angkatan       int     `json:"angkatan"`
   Ipk            float64 `json:"ipk"`
   Aktif          *bool   `json:"aktif"`
}

// Modul 7 tugas no 1
type PermintaanMatakuliah struct {
   Kode     string `json:"kode"`
   Nama     string `json:"nama"`
   Sks      int    `json:"sks"`
   Semester int    `json:"semester"`
}

// Modul 7 tugas no 2
type ResponsProgramStudi struct {
   ID              uint   `json:"id"`
   Kode            string `json:"kode"`
   Nama            string `json:"nama"`
   Jenjang         string `json:"jenjang"`
   JumlahMahasiswa int64  `json:"jumlah_mahasiswa"`
}