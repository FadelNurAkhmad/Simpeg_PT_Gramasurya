DROP TABLE tb_anak;

CREATE TABLE `tb_anak` (
  `id_anak` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tmp_lhr` varchar(64) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `jk` varchar(12) NOT NULL,
  `pendidikan` varchar(8) NOT NULL,
  `pekerjaan` varchar(32) NOT NULL,
  `status_hub` varchar(16) NOT NULL,
  `date_reg` date NOT NULL,
  PRIMARY KEY (`id_anak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_anak VALUES("1","1","1234001100110091","Andi","Banjarnegara","2009-01-12","Laki-laki","SLTA","","Anak Kandung","2017-01-21");
INSERT INTO tb_anak VALUES("2","1","1234001100110092","Indra Lui","Banjarnegara","2012-06-10","Laki-laki","SD","","Anak Kandung","2017-01-21");
INSERT INTO tb_anak VALUES("3","5","3201982873120111","Abraham Hatmoko","Cilacap","2008-07-20","Laki-laki","SD","","Anak Kandung","2017-01-24");
INSERT INTO tb_anak VALUES("4","4","3101017487210001","Anita","Jakarta","2010-04-07","Perempuan","SD","","Anak Kandung","2017-02-21");
INSERT INTO tb_anak VALUES("5","9","3301017002410001","Amel","Jakarta","2005-10-25","Perempuan","SLTP","","Anak Kandung","2017-02-21");
INSERT INTO tb_anak VALUES("6","10","3101010001210001","Chandra","Jakarta","2005-08-26","Laki-laki","SLTP","","Anak Kandung","2017-02-21");
INSERT INTO tb_anak VALUES("7","2","3101010001210005","Bunga","Jakarta","2000-02-15","Perempuan","SLTA","-","Anak Kandung","2017-02-21");
INSERT INTO tb_anak VALUES("8","11","3101010988210002","Jaynuddin","Magelang","1980-02-05","Laki-laki","D3","-","Anak Kandung","2017-02-21");
INSERT INTO tb_anak VALUES("9","13","329848940800001","Indrasara K","Jakarta","2016-01-26","Laki-laki","","-","Anak Kandung","2018-02-11");
INSERT INTO tb_anak VALUES("10","12","443413134167177","Faisal H","Cilacap","2001-03-07","Laki-laki","SLTA","-","Anak Kandung","2018-02-11");
INSERT INTO tb_anak VALUES("11","12","3206668891183931","Fatimah R","Cilacap","2007-06-26","Perempuan","SD","-","Anak Kandung","2018-02-11");
INSERT INTO tb_anak VALUES("12","14","439272974777","Kusuma P","Bandung","2009-05-18","Laki-laki","SD","-","Anak Kandung","2018-02-11");
INSERT INTO tb_anak VALUES("13","15","12347658101 02","Harjasa T","Cilacap","2010-01-01","Laki-laki","SD","-","Anak Kandung","2018-02-25");



DROP TABLE tb_bahasa;

CREATE TABLE `tb_bahasa` (
  `id_bhs` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `jns_bhs` varchar(32) NOT NULL,
  `bahasa` varchar(32) NOT NULL,
  `kemampuan` varchar(8) NOT NULL,
  PRIMARY KEY (`id_bhs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_bahasa VALUES("1","1","Asing","English","Pasif");
INSERT INTO tb_bahasa VALUES("2","2","Asing","English","Pasif");
INSERT INTO tb_bahasa VALUES("3","3","Asing","English","Aktif");
INSERT INTO tb_bahasa VALUES("4","4","Asing","Inggris","Aktif");
INSERT INTO tb_bahasa VALUES("5","9","Asing","Inggris","Aktif");
INSERT INTO tb_bahasa VALUES("6","10","Asing","Inggris","Aktif");
INSERT INTO tb_bahasa VALUES("7","11","Asing","Inggris","Aktif");
INSERT INTO tb_bahasa VALUES("8","13","Asing","Inggris","Pasif");
INSERT INTO tb_bahasa VALUES("9","14","Asing","Prancis","Pasif");
INSERT INTO tb_bahasa VALUES("10","15","Asing","Rusian","Pasif");



DROP TABLE tb_cuti;

CREATE TABLE `tb_cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `jns_cuti` varchar(32) NOT NULL,
  `no_suratcuti` varchar(32) NOT NULL,
  `tgl_suratcuti` date NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `lama` int(11) NOT NULL,
  `lama_terbilang` varchar(255) NOT NULL,
  `lama_satuan` varchar(255) NOT NULL,
  `point1` varchar(2) NOT NULL,
  `ket1` varchar(255) NOT NULL,
  `point2` varchar(2) NOT NULL,
  `ket2` varchar(255) NOT NULL,
  `point3` varchar(2) NOT NULL,
  `ket3` varchar(255) NOT NULL,
  `tembusan1` varchar(255) NOT NULL,
  `tembusan2` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cuti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_cuti VALUES("2","10","Sakit","854 / 0011 / FF / 2018","2018-01-10","2018-01-15","2018-04-15","1","Satu","Bulan","a.","Sebelum menjalankan cuti sakit wajib menyerahkan pekerjaannya kepada Atasan langsungnya ;","b.","Setelah selesai menjalankan cuti sakit wajib melaporkan diri kepada Atasan langsungnya dan bekerja kembali sebagaimana biasanya.","","","Tembusan A1","Tembusan B1");
INSERT INTO tb_cuti VALUES("3","9","Bersalin","854 / 0012 / FF / 2018","2018-01-21","2018-02-01","2018-05-01","3","Tiga","Bulan","a.","Sebelum menjalankan Cuti Bersalin wajib menyerahkan pekerjaannya kepada Atasan\nLangsungnya atau Pejabat lain yang ditunjuk ;","b.","Segera setelah persalinan yang bersangkutan supaya memberitahukan tanggal persalinan\nkepada Pejabat yang berwenang memberikan cuti ;","c.","Setelah menjalankan Cuti Bersalin wajib melaporkan diri kepada Atasan Langsungnya dan bekerja kembali sebagaimana biasa.","Tembusan A","Tembusan B");
INSERT INTO tb_cuti VALUES("4","11","Besar","854 / 0014 / FF / 2018","2018-01-02","2018-02-01","2018-05-01","3","Tiga","Bulan","a.","Sebelum menjalankan cuti besar wajib menyerahkan pekerjaannya kepada Atasan langsungnya atau pejabat lain yang ditunjuk","b.","Selama menjalankan cuti besar, tidak berhak atas tunjangan jabatan struktural dan Tunjangan Kinerja Daerah (TKD)","c.","Setelah selesai menjalankan cuti Besar wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana biasa","Tembusan A","Tembusan B");
INSERT INTO tb_cuti VALUES("5","12","Sakit","13123124121","2018-01-02","2018-01-04","2018-01-10","7","Tujuh","Hari","a.","Sebelum menjalankan cuti sakit wajib menyerahkan pekerjaannya kepada Atasan langsungnya ;","b.","Setelah selesai menjalankan cuti sakit wajib melaporkan diri kepada Atasan langsungnya dan bekerja kembali sebagaimana biasanya.","","","Tembusan A","Tembusan B");
INSERT INTO tb_cuti VALUES("6","15","Sakit","12/2018/01-CT-01","2018-01-04","2018-02-05","2018-02-08","4","Empat","Hari","a.","Sebelum menjalankan cuti sakit wajib menyerahkan permohona surat kepada atasan","b.","Setelah selesai menjalankan cuti sakit wajib melapor kepada atasan","","","Tembusan 1","Tembusan 2");



DROP TABLE tb_diklat;

CREATE TABLE `tb_diklat` (
  `id_diklat` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `diklat` varchar(128) NOT NULL,
  `jml_jam` int(4) NOT NULL,
  `penyelenggara` varchar(64) NOT NULL,
  `tempat` varchar(32) NOT NULL,
  `angkatan` varchar(4) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `no_sttpp` varchar(32) NOT NULL,
  `tgl_sttpp` date NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id_diklat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_diklat VALUES("1","1","Diklat A1","40","Universal B","Gedung HI","3","2015","123456101","2015-06-01","");
INSERT INTO tb_diklat VALUES("2","2","Diklat A3","24","Dinas Pasar","Aula 1 Dinas Pasar","II","2001","12345617101","2001-12-27","");
INSERT INTO tb_diklat VALUES("3","11","DIKLAT PIM IV","241","Pemda","Bandung","XXI","2011","11186473-DK1","2011-02-08","Sejarah HTML.pdf");
INSERT INTO tb_diklat VALUES("4","14","Diklat PIM III","120","Pemerintah Kabupaten","Cilacap","XI","2017","121321432101","2017-02-06","Pengertian Web Statis dan Web Dinamis.pdf");
INSERT INTO tb_diklat VALUES("5","15","Diklat PIM IV","240","Pemerintah Kabupaten","Cilacap","XII","2015","364335363-01901","2015-01-08","Apa itu HTML - Hyper Text Markup Language.pdf");



DROP TABLE tb_hukuman;

CREATE TABLE `tb_hukuman` (
  `id_hukuman` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `hukuman` varchar(64) NOT NULL,
  `pejabat_sk` varchar(64) NOT NULL,
  `no_sk` varchar(32) NOT NULL,
  `tgl_sk` date NOT NULL,
  `pejabat_pulih` varchar(64) NOT NULL,
  `no_pulih` varchar(32) NOT NULL,
  `tgl_pulih` date NOT NULL,
  `gol` varchar(6) NOT NULL,
  `pangkat` varchar(32) NOT NULL,
  `eselon` varchar(16) NOT NULL,
  PRIMARY KEY (`id_hukuman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_hukuman VALUES("1","1","Teguran Tertulis","Andi, SH","123451","2016-01-01","Rajasa","542121","2017-01-01","II/D","Wakil Sekretaris","III/d");
INSERT INTO tb_hukuman VALUES("2","2","Teguran Lisan","Intan, SH","6761414202091","2017-01-17","Rajasa, SH","12121210901","0000-00-00","III/D","Kepala Dinas","III/b");
INSERT INTO tb_hukuman VALUES("3","3","Teguran Lisan","Rajasa, SH","12309010001","2017-02-01","Inara, MM","12309010002","2017-02-28","III/A","Waka Dinas","III/c");
INSERT INTO tb_hukuman VALUES("4","4","Teguran Lisan","Rajasa, SH","12309010001","2017-02-01","Inara, MM","123090100021","2017-02-21","IV/A","Pembina","IV/A");
INSERT INTO tb_hukuman VALUES("5","11","Teguran Lisan","Rajasa, SH","12309010001","2015-02-01","Inara, MM","12309010002","2015-03-01","II/A","Anggota","II/b");
INSERT INTO tb_hukuman VALUES("6","13","Teguran Lisan","Rajasa, SH","123456111","2018-02-01","Rajasa, SH","534312111","2018-02-07","","","III/A");
INSERT INTO tb_hukuman VALUES("7","14","Teguran Lisan","Rajasa , SH","12345671861","2016-03-02","Rajasa, SH","12432423-091","2016-03-15","III/A","Penata","III/B");
INSERT INTO tb_hukuman VALUES("8","15","Teguran Lisan","Hatmoko, MM","12312131221","2018-02-01"," Hatmoko, MM","1231213122-01","2018-02-25","III/A","Penata Muda","III/A");



DROP TABLE tb_jabatan;

CREATE TABLE `tb_jabatan` (
  `id_jab` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `jabatan` varchar(64) NOT NULL,
  `eselon` varchar(16) NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `tgl_sk` date NOT NULL,
  `tmt_jabatan` date NOT NULL,
  `sampai_tgl` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `status_jab` varchar(5) NOT NULL,
  `jk_jab` varchar(12) NOT NULL,
  PRIMARY KEY (`id_jab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_jabatan VALUES("1","1","Staff","III/d","","0000-00-00","2015-05-11","2017-01-01","","Aktif","Perempuan");
INSERT INTO tb_jabatan VALUES("2","2","Kepala Seksi","III/b","","0000-00-00","2014-05-01","2017-01-01","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("3","3","Pengatur","II/b","","0000-00-00","2013-05-05","2014-01-08","","","Perempuan");
INSERT INTO tb_jabatan VALUES("4","3","Waka Seksi","III/c","","0000-00-00","2013-05-07","2013-12-31","","Aktif","Perempuan");
INSERT INTO tb_jabatan VALUES("5","5","Hakim Tinggi","V/A","","0000-00-00","2015-06-08","0000-00-00","","","Laki-laki");
INSERT INTO tb_jabatan VALUES("6","5","Penata III","III/d","","0000-00-00","2015-05-05","2015-12-30","","","");
INSERT INTO tb_jabatan VALUES("7","4","Waka Dinas","IV/A","","0000-00-00","2012-06-12","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("8","9","Kepala Seksi","III/d","","0000-00-00","2012-06-07","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("9","10","Waka Seksi","III/c","","0000-00-00","2011-06-14","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("10","5","Kepala Dinas","IV/B","","0000-00-00","2017-02-01","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("11","6","Staff","II/b","","0000-00-00","2013-06-01","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("13","8","Staff","II/b","","0000-00-00","2013-06-01","0000-00-00","","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("14","11","Staff","II/b","21389124921719","2009-01-10","2009-01-02","2012-01-02","Sejarah HTML.pdf","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("16","13","Staff","III/A","327362399991","2016-04-27","2017-02-07","0000-00-00","Apa itu HTML - Hyper Text Markup Language.pdf","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("17","12","Staff","III/A","123456221","2015-04-22","2016-03-21","0000-00-00","Sejarah HTML.pdf","Aktif","Perempuan");
INSERT INTO tb_jabatan VALUES("19","14","Pengawas","III/B","2136356391","2016-01-02","2016-03-16","0000-00-00","Pengertian Web Statis dan Web Dinamis.pdf","Aktif","Laki-laki");
INSERT INTO tb_jabatan VALUES("20","15","Sekretaris","III/A","12345-09101","2016-01-05","2015-12-01","0000-00-00","Sejarah HTML.pdf","Aktif","Perempuan");



DROP TABLE tb_kawin;

CREATE TABLE `tb_kawin` (
  `id_kawin` int(11) NOT NULL,
  `no_kawin` varchar(32) NOT NULL,
  `tgl_izin` date NOT NULL,
  `id_peg` int(11) NOT NULL,
  `bangsa1` varchar(255) NOT NULL,
  `nama_wali_bapak1` varchar(255) NOT NULL,
  `kerja_wali_bapak1` varchar(255) NOT NULL,
  `alamat_wali_bapak1` varchar(255) NOT NULL,
  `nama_wali_ibu1` varchar(255) NOT NULL,
  `kerja_wali_ibu1` varchar(255) NOT NULL,
  `alamat_wali_ibu1` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tmp_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `gol` varchar(255) NOT NULL,
  `jab` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `bangsa2` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_wali_bapak2` varchar(255) NOT NULL,
  `kerja_wali_bapak2` varchar(255) NOT NULL,
  `alamat_wali_bapak2` varchar(255) NOT NULL,
  `nama_wali_ibu2` varchar(255) NOT NULL,
  `kerja_wali_ibu2` varchar(255) NOT NULL,
  `alamat_wali_ibu2` varchar(255) NOT NULL,
  `tmp_kawin` varchar(255) NOT NULL,
  `tgl_kawin` date NOT NULL,
  `tgl_ditetapkan` date NOT NULL,
  PRIMARY KEY (`id_kawin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_kawin VALUES("1","474.4/01/FF/2011","2018-01-03","11","Indonesia","LA DJAHIRI","Swasta","Kayu Merah","WA IDA","IRT","Kayu Merah","RAHIM, A.md","Fakfak","1981-05-10","","","","","","","Indonesia","Islam","Danaweria","MOHAMMAD BAKRI ALI","(Alm)","","TASLIN NITISONO","IRT","Danaweria","Fakfak","2014-09-16","2012-12-26");
INSERT INTO tb_kawin VALUES("2","213241421666","2018-02-03","12","Indonesia","Jauhari L","Wiraswasta","Kesugihan","Munirah","Ibu Rumah Tangga","Kesugihan","Abrahim H","Surakarta","1971-03-17","PNS","8242862782393011","Anggota","II/C","Staff","Puskemas I Karangnangka","Indoenesia","Islam","Karangnangka","Suroto","Karyawan","Karangnangka","Haidar T","Pedagang","Karangnangka","Cilacap","2018-02-17","2018-02-03");
INSERT INTO tb_kawin VALUES("3","21324142166622","2016-02-01","13","Indonesia","Supratman S","Wiraswasta","Boyolali","Munirah","-"," Boyolali","Safila L","Jakarta","1989-02-28","-","320108348464001","-","-","-","-","Indoenesia","Islam","Jakarta","Suroto","Karyawan","Jakarta","Haidar T","-","Jakarta","Jakarta","2016-03-01","2016-01-02");
INSERT INTO tb_kawin VALUES("4","474.4/01/CLP-2011","2010-02-02","15","Indonesia","Irhan Z","Wiraswasta","Bandung","Iyanah I","-","Bandung","Budiman L","Jakarta","1983-07-09","Wiraswasta","12324211421-019201","-","-","-","-","Indonesia","Islam","Jakarta","Jainudin J","Wiraswasta","Jakarta","Siti S","-","Jakarta","Cilacap","2009-09-21","2018-02-01");



DROP TABLE tb_kgb;

CREATE TABLE `tb_kgb` (
  `id_peg` int(11) NOT NULL,
  `tgl_kgb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_kgb VALUES("5","2017-01-24");
INSERT INTO tb_kgb VALUES("5","2019-01-24");
INSERT INTO tb_kgb VALUES("5","2021-01-24");
INSERT INTO tb_kgb VALUES("5","2023-01-24");
INSERT INTO tb_kgb VALUES("5","2025-01-24");
INSERT INTO tb_kgb VALUES("5","2027-01-24");
INSERT INTO tb_kgb VALUES("5","2029-01-24");
INSERT INTO tb_kgb VALUES("5","2031-01-24");
INSERT INTO tb_kgb VALUES("5","2033-01-24");
INSERT INTO tb_kgb VALUES("5","2035-01-24");
INSERT INTO tb_kgb VALUES("5","2037-01-24");
INSERT INTO tb_kgb VALUES("1","2016-01-02");
INSERT INTO tb_kgb VALUES("1","2018-01-02");
INSERT INTO tb_kgb VALUES("1","2020-01-02");
INSERT INTO tb_kgb VALUES("1","2022-01-02");
INSERT INTO tb_kgb VALUES("1","2024-01-02");
INSERT INTO tb_kgb VALUES("1","2026-01-02");
INSERT INTO tb_kgb VALUES("1","2028-01-02");
INSERT INTO tb_kgb VALUES("1","2030-01-02");
INSERT INTO tb_kgb VALUES("1","2032-01-02");
INSERT INTO tb_kgb VALUES("1","2034-01-02");
INSERT INTO tb_kgb VALUES("1","2036-01-02");
INSERT INTO tb_kgb VALUES("1","2038-01-02");
INSERT INTO tb_kgb VALUES("1","2040-01-02");
INSERT INTO tb_kgb VALUES("1","2042-01-02");
INSERT INTO tb_kgb VALUES("1","2044-01-02");
INSERT INTO tb_kgb VALUES("11","2016-01-31");
INSERT INTO tb_kgb VALUES("11","2018-01-31");
INSERT INTO tb_kgb VALUES("11","2020-01-31");
INSERT INTO tb_kgb VALUES("11","2022-01-31");
INSERT INTO tb_kgb VALUES("11","2024-01-31");
INSERT INTO tb_kgb VALUES("11","2026-01-31");
INSERT INTO tb_kgb VALUES("11","2028-01-31");
INSERT INTO tb_kgb VALUES("10","2017-01-04");
INSERT INTO tb_kgb VALUES("10","2019-01-04");
INSERT INTO tb_kgb VALUES("10","2021-01-04");
INSERT INTO tb_kgb VALUES("10","2023-01-04");
INSERT INTO tb_kgb VALUES("10","2025-01-04");
INSERT INTO tb_kgb VALUES("10","2027-01-04");
INSERT INTO tb_kgb VALUES("10","2029-01-04");
INSERT INTO tb_kgb VALUES("10","2031-01-04");
INSERT INTO tb_kgb VALUES("10","2033-01-04");
INSERT INTO tb_kgb VALUES("9","2015-01-21");
INSERT INTO tb_kgb VALUES("9","2017-01-21");
INSERT INTO tb_kgb VALUES("9","2019-01-21");
INSERT INTO tb_kgb VALUES("9","2021-01-21");
INSERT INTO tb_kgb VALUES("9","2023-01-21");
INSERT INTO tb_kgb VALUES("9","2025-01-21");
INSERT INTO tb_kgb VALUES("9","2027-01-21");
INSERT INTO tb_kgb VALUES("9","2029-01-21");
INSERT INTO tb_kgb VALUES("9","2031-01-21");
INSERT INTO tb_kgb VALUES("8","2016-11-30");
INSERT INTO tb_kgb VALUES("8","2018-11-30");
INSERT INTO tb_kgb VALUES("7","2016-12-14");
INSERT INTO tb_kgb VALUES("6","2016-07-12");
INSERT INTO tb_kgb VALUES("4","2016-10-30");
INSERT INTO tb_kgb VALUES("4","2018-10-30");
INSERT INTO tb_kgb VALUES("4","2020-10-30");
INSERT INTO tb_kgb VALUES("4","2022-10-30");
INSERT INTO tb_kgb VALUES("4","2024-10-30");
INSERT INTO tb_kgb VALUES("4","2026-10-30");
INSERT INTO tb_kgb VALUES("4","2028-10-30");
INSERT INTO tb_kgb VALUES("4","2030-10-30");
INSERT INTO tb_kgb VALUES("4","2032-10-30");
INSERT INTO tb_kgb VALUES("4","2034-10-30");
INSERT INTO tb_kgb VALUES("4","2036-10-30");
INSERT INTO tb_kgb VALUES("4","2038-10-30");
INSERT INTO tb_kgb VALUES("4","2040-10-30");
INSERT INTO tb_kgb VALUES("3","2017-01-03");
INSERT INTO tb_kgb VALUES("3","2019-01-03");
INSERT INTO tb_kgb VALUES("3","2021-01-03");
INSERT INTO tb_kgb VALUES("3","2023-01-03");
INSERT INTO tb_kgb VALUES("3","2025-01-03");
INSERT INTO tb_kgb VALUES("3","2027-01-03");
INSERT INTO tb_kgb VALUES("3","2029-01-03");
INSERT INTO tb_kgb VALUES("3","2031-01-03");
INSERT INTO tb_kgb VALUES("3","2033-01-03");
INSERT INTO tb_kgb VALUES("12","2015-01-02");
INSERT INTO tb_kgb VALUES("12","2017-01-02");
INSERT INTO tb_kgb VALUES("12","2019-01-02");
INSERT INTO tb_kgb VALUES("12","2021-01-02");
INSERT INTO tb_kgb VALUES("12","2023-01-02");
INSERT INTO tb_kgb VALUES("12","2025-01-02");
INSERT INTO tb_kgb VALUES("12","2027-01-02");
INSERT INTO tb_kgb VALUES("12","2029-01-02");
INSERT INTO tb_kgb VALUES("12","2031-01-02");
INSERT INTO tb_kgb VALUES("12","2033-01-02");
INSERT INTO tb_kgb VALUES("12","2035-01-02");
INSERT INTO tb_kgb VALUES("13","2016-02-27");
INSERT INTO tb_kgb VALUES("13","2018-02-27");
INSERT INTO tb_kgb VALUES("13","2020-02-27");
INSERT INTO tb_kgb VALUES("13","2022-02-27");
INSERT INTO tb_kgb VALUES("13","2024-02-27");
INSERT INTO tb_kgb VALUES("13","2026-02-27");
INSERT INTO tb_kgb VALUES("13","2028-02-27");
INSERT INTO tb_kgb VALUES("13","2030-02-27");
INSERT INTO tb_kgb VALUES("13","2032-02-27");
INSERT INTO tb_kgb VALUES("13","2034-02-27");
INSERT INTO tb_kgb VALUES("13","2036-02-27");
INSERT INTO tb_kgb VALUES("13","2038-02-27");
INSERT INTO tb_kgb VALUES("13","2040-02-27");
INSERT INTO tb_kgb VALUES("13","2042-02-27");
INSERT INTO tb_kgb VALUES("13","2044-02-27");
INSERT INTO tb_kgb VALUES("2","2016-12-21");
INSERT INTO tb_kgb VALUES("2","2018-12-21");
INSERT INTO tb_kgb VALUES("2","2020-12-21");
INSERT INTO tb_kgb VALUES("2","2022-12-21");
INSERT INTO tb_kgb VALUES("2","2024-12-21");
INSERT INTO tb_kgb VALUES("2","2026-12-21");
INSERT INTO tb_kgb VALUES("2","2028-12-21");
INSERT INTO tb_kgb VALUES("2","2030-12-21");
INSERT INTO tb_kgb VALUES("2","2032-12-21");
INSERT INTO tb_kgb VALUES("14","2014-02-02");
INSERT INTO tb_kgb VALUES("14","2016-02-02");
INSERT INTO tb_kgb VALUES("14","2018-02-02");
INSERT INTO tb_kgb VALUES("14","2020-02-02");
INSERT INTO tb_kgb VALUES("14","2022-02-02");
INSERT INTO tb_kgb VALUES("14","2024-02-02");
INSERT INTO tb_kgb VALUES("14","2026-02-02");
INSERT INTO tb_kgb VALUES("14","2028-02-02");
INSERT INTO tb_kgb VALUES("14","2030-02-02");
INSERT INTO tb_kgb VALUES("14","2032-02-02");
INSERT INTO tb_kgb VALUES("14","2034-02-02");
INSERT INTO tb_kgb VALUES("14","2036-02-02");
INSERT INTO tb_kgb VALUES("14","2038-02-02");
INSERT INTO tb_kgb VALUES("14","2040-02-02");
INSERT INTO tb_kgb VALUES("14","2042-02-02");
INSERT INTO tb_kgb VALUES("14","2044-02-02");
INSERT INTO tb_kgb VALUES("15","2014-03-31");
INSERT INTO tb_kgb VALUES("15","2016-03-31");
INSERT INTO tb_kgb VALUES("15","2018-03-31");
INSERT INTO tb_kgb VALUES("15","2020-03-31");
INSERT INTO tb_kgb VALUES("15","2022-03-31");
INSERT INTO tb_kgb VALUES("15","2024-03-31");
INSERT INTO tb_kgb VALUES("15","2026-03-31");
INSERT INTO tb_kgb VALUES("15","2028-03-31");
INSERT INTO tb_kgb VALUES("15","2030-03-31");
INSERT INTO tb_kgb VALUES("15","2032-03-31");
INSERT INTO tb_kgb VALUES("15","2034-03-31");
INSERT INTO tb_kgb VALUES("15","2036-03-31");
INSERT INTO tb_kgb VALUES("15","2038-03-31");
INSERT INTO tb_kgb VALUES("15","2040-03-31");
INSERT INTO tb_kgb VALUES("15","2042-03-31");



DROP TABLE tb_kpb;

CREATE TABLE `tb_kpb` (
  `id_peg` int(11) NOT NULL,
  `tgl_kpb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_kpb VALUES("5","2017-01-01");
INSERT INTO tb_kpb VALUES("5","2021-01-01");
INSERT INTO tb_kpb VALUES("5","2025-01-01");
INSERT INTO tb_kpb VALUES("5","2029-01-01");
INSERT INTO tb_kpb VALUES("5","2033-01-01");
INSERT INTO tb_kpb VALUES("5","2037-01-01");
INSERT INTO tb_kpb VALUES("1","2014-01-22");
INSERT INTO tb_kpb VALUES("1","2018-01-22");
INSERT INTO tb_kpb VALUES("1","2022-01-22");
INSERT INTO tb_kpb VALUES("1","2026-01-22");
INSERT INTO tb_kpb VALUES("1","2030-01-22");
INSERT INTO tb_kpb VALUES("1","2034-01-22");
INSERT INTO tb_kpb VALUES("1","2038-01-22");
INSERT INTO tb_kpb VALUES("1","2042-01-22");
INSERT INTO tb_kpb VALUES("11","2017-01-01");
INSERT INTO tb_kpb VALUES("11","2021-01-01");
INSERT INTO tb_kpb VALUES("11","2025-01-01");
INSERT INTO tb_kpb VALUES("10","2017-02-01");
INSERT INTO tb_kpb VALUES("10","2021-02-01");
INSERT INTO tb_kpb VALUES("10","2025-02-01");
INSERT INTO tb_kpb VALUES("10","2029-02-01");
INSERT INTO tb_kpb VALUES("10","2033-02-01");
INSERT INTO tb_kpb VALUES("9","2015-01-27");
INSERT INTO tb_kpb VALUES("9","2019-01-27");
INSERT INTO tb_kpb VALUES("9","2023-01-27");
INSERT INTO tb_kpb VALUES("9","2027-01-27");
INSERT INTO tb_kpb VALUES("9","2031-01-27");
INSERT INTO tb_kpb VALUES("8","2016-12-07");
INSERT INTO tb_kpb VALUES("7","2016-12-06");
INSERT INTO tb_kpb VALUES("6","2014-06-03");
INSERT INTO tb_kpb VALUES("4","2016-11-27");
INSERT INTO tb_kpb VALUES("4","2020-11-27");
INSERT INTO tb_kpb VALUES("4","2024-11-27");
INSERT INTO tb_kpb VALUES("4","2028-11-27");
INSERT INTO tb_kpb VALUES("4","2032-11-27");
INSERT INTO tb_kpb VALUES("4","2036-11-27");
INSERT INTO tb_kpb VALUES("4","2040-11-27");
INSERT INTO tb_kpb VALUES("3","2017-01-04");
INSERT INTO tb_kpb VALUES("3","2021-01-04");
INSERT INTO tb_kpb VALUES("3","2025-01-04");
INSERT INTO tb_kpb VALUES("3","2029-01-04");
INSERT INTO tb_kpb VALUES("3","2033-01-04");
INSERT INTO tb_kpb VALUES("12","2014-01-02");
INSERT INTO tb_kpb VALUES("12","2018-01-02");
INSERT INTO tb_kpb VALUES("12","2022-01-02");
INSERT INTO tb_kpb VALUES("12","2026-01-02");
INSERT INTO tb_kpb VALUES("12","2030-01-02");
INSERT INTO tb_kpb VALUES("12","2034-01-02");
INSERT INTO tb_kpb VALUES("13","2014-02-28");
INSERT INTO tb_kpb VALUES("13","2018-02-28");
INSERT INTO tb_kpb VALUES("13","2022-02-28");
INSERT INTO tb_kpb VALUES("13","2026-02-28");
INSERT INTO tb_kpb VALUES("13","2030-02-28");
INSERT INTO tb_kpb VALUES("13","2034-02-28");
INSERT INTO tb_kpb VALUES("13","2038-02-28");
INSERT INTO tb_kpb VALUES("13","2042-02-28");
INSERT INTO tb_kpb VALUES("2","2016-12-06");
INSERT INTO tb_kpb VALUES("2","2020-12-06");
INSERT INTO tb_kpb VALUES("2","2024-12-06");
INSERT INTO tb_kpb VALUES("2","2028-12-06");
INSERT INTO tb_kpb VALUES("2","2032-12-06");
INSERT INTO tb_kpb VALUES("14","2014-02-02");
INSERT INTO tb_kpb VALUES("14","2018-02-02");
INSERT INTO tb_kpb VALUES("14","2022-02-02");
INSERT INTO tb_kpb VALUES("14","2026-02-02");
INSERT INTO tb_kpb VALUES("14","2030-02-02");
INSERT INTO tb_kpb VALUES("14","2034-02-02");
INSERT INTO tb_kpb VALUES("14","2038-02-02");
INSERT INTO tb_kpb VALUES("14","2042-02-02");
INSERT INTO tb_kpb VALUES("15","2016-03-31");
INSERT INTO tb_kpb VALUES("15","2020-03-31");
INSERT INTO tb_kpb VALUES("15","2024-03-31");
INSERT INTO tb_kpb VALUES("15","2028-03-31");
INSERT INTO tb_kpb VALUES("15","2032-03-31");
INSERT INTO tb_kpb VALUES("15","2036-03-31");
INSERT INTO tb_kpb VALUES("15","2040-03-31");



DROP TABLE tb_lat_jabatan;

CREATE TABLE `tb_lat_jabatan` (
  `id_lat_jabatan` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `nama_pelatih` varchar(64) NOT NULL,
  `tahun_lat` varchar(4) NOT NULL,
  `jml_jam` varchar(3) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id_lat_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_lat_jabatan VALUES("1","1","Rajasa, SH","2015","30","Sejarah HTML.pdf");
INSERT INTO tb_lat_jabatan VALUES("3","3","Rajasa, SH","2015","30","Cara Melakukan Ping Website Blog.pdf");
INSERT INTO tb_lat_jabatan VALUES("5","4","Intan KH, MM","2011","210","Cara Melakukan Ping Website Blog.pdf");
INSERT INTO tb_lat_jabatan VALUES("6","11","Hatmoko Andi, ST","2014","240","Sejarah HTML.pdf");



DROP TABLE tb_masteresl;

CREATE TABLE `tb_masteresl` (
  `id_masteresl` int(11) NOT NULL,
  `nama_masteresl` varchar(6) NOT NULL,
  PRIMARY KEY (`id_masteresl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_masteresl VALUES("5","II/C");
INSERT INTO tb_masteresl VALUES("7","IV/B");
INSERT INTO tb_masteresl VALUES("8","III/A");
INSERT INTO tb_masteresl VALUES("9","IV/A");
INSERT INTO tb_masteresl VALUES("10","III/D");
INSERT INTO tb_masteresl VALUES("11","III/C");
INSERT INTO tb_masteresl VALUES("12","III/B");
INSERT INTO tb_masteresl VALUES("13","II/B");
INSERT INTO tb_masteresl VALUES("14","II/A");
INSERT INTO tb_masteresl VALUES("15","II/D");



DROP TABLE tb_mastergol;

CREATE TABLE `tb_mastergol` (
  `id_mastergol` int(11) NOT NULL,
  `nama_mastergol` varchar(6) NOT NULL,
  PRIMARY KEY (`id_mastergol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_mastergol VALUES("1","IV/A");
INSERT INTO tb_mastergol VALUES("2","III/D");
INSERT INTO tb_mastergol VALUES("3","III/C");
INSERT INTO tb_mastergol VALUES("4","III/B");
INSERT INTO tb_mastergol VALUES("5","II/B");
INSERT INTO tb_mastergol VALUES("6","II/A");
INSERT INTO tb_mastergol VALUES("8","III/A");
INSERT INTO tb_mastergol VALUES("11","IV/B");
INSERT INTO tb_mastergol VALUES("13","II/C");
INSERT INTO tb_mastergol VALUES("14","I/A");



DROP TABLE tb_masterjab;

CREATE TABLE `tb_masterjab` (
  `id_masterjab` int(11) NOT NULL,
  `nama_masterjab` varchar(64) NOT NULL,
  PRIMARY KEY (`id_masterjab`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_masterjab VALUES("1","Kepala Badan Kepegawaian Daerah");
INSERT INTO tb_masterjab VALUES("3","Sekretaris Daerah");
INSERT INTO tb_masterjab VALUES("4","Staff");
INSERT INTO tb_masterjab VALUES("6","Asisten Pemerintahan");
INSERT INTO tb_masterjab VALUES("7","Staff Ahli");
INSERT INTO tb_masterjab VALUES("8","Kabid");
INSERT INTO tb_masterjab VALUES("9","Kabag");
INSERT INTO tb_masterjab VALUES("10","Sekretaris");



DROP TABLE tb_mutasi;

CREATE TABLE `tb_mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `jns_mutasi` varchar(32) NOT NULL,
  `tgl_mutasi` date NOT NULL,
  `no_mutasi` varchar(32) NOT NULL,
  `gol` varchar(6) NOT NULL,
  `pangkat` varchar(32) NOT NULL,
  `eselon` varchar(16) NOT NULL,
  PRIMARY KEY (`id_mutasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_mutasi VALUES("1","1","Masuk","2017-12-01","1234M0012","II/D","Pengatur","III/d");
INSERT INTO tb_mutasi VALUES("2","5","Masuk","2017-01-10","1234SJ109101","IV/A","Pembina","V/A");
INSERT INTO tb_mutasi VALUES("5","11","Kenaikan Pangkat","2017-01-03","M-010123","II/A","Pengatur","II/b");
INSERT INTO tb_mutasi VALUES("6","6","Masuk","2016-06-15","M09/01-01","II/A","Anggota","II/b");
INSERT INTO tb_mutasi VALUES("7","12","Masuk","2018-02-01","12313124-1","","","");
INSERT INTO tb_mutasi VALUES("8","14","Masuk","2016-01-02","32543251","III/A","Penata","III/B");
INSERT INTO tb_mutasi VALUES("9","15","Masuk","2012-01-04","534353781-01","III/A","Penata Muda","III/A");



DROP TABLE tb_ortu;

CREATE TABLE `tb_ortu` (
  `id_ortu` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tmp_lhr` varchar(64) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `pendidikan` varchar(8) NOT NULL,
  `pekerjaan` varchar(32) NOT NULL,
  `status_hub` varchar(16) NOT NULL,
  `date_reg` date NOT NULL,
  PRIMARY KEY (`id_ortu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_ortu VALUES("1","1","1111000099991011","Pranoto M","Banyumas","1970-02-03","SLTP","Wiraswasta","Ayah Kandung","2017-01-21");
INSERT INTO tb_ortu VALUES("2","1","1201019090111212","Sitiah","Palembang","1970-01-07","SD","Ibu Rumah Tangga","Ibu Kandung","2017-01-21");
INSERT INTO tb_ortu VALUES("3","10","3101019081210001","Ahmad","Magelang","1954-05-09","SLTP","PNS","Ayah Kandung","2017-02-21");
INSERT INTO tb_ortu VALUES("4","9","3101010081210001","Sutisna","Bandung","1959-11-26","SLTP","PNS","Ayah Kandung","2017-02-21");
INSERT INTO tb_ortu VALUES("5","4","3101011201210001","Abdullah","Aceh Barat","1950-01-04","SLTP","PNS","Ayah Kandung","2017-02-21");
INSERT INTO tb_ortu VALUES("6","2","3201010001210001","Maimunah","Sukabumi","1960-01-04","SD","-","Ibu Kandung","2017-02-21");
INSERT INTO tb_ortu VALUES("7","11","9087654321009011","Dahlan D","Kebumen","1946-08-14","SLTA","PNS","Ayah Kandung","2017-12-13");
INSERT INTO tb_ortu VALUES("8","13","443413134167100","Supratman S","Boyolali","1959-01-08","SD","Wiraswasta","Ayah Kandung","2018-02-11");
INSERT INTO tb_ortu VALUES("9","12","320102066683930","Soedjono T","Malang","1954-09-27","SD","Wiraswasta","Ayah Kandung","2018-02-11");
INSERT INTO tb_ortu VALUES("10","14","22133232998871","Sukandar J","Jogjakarta","1959-01-20","SLTP","Wiraswasta","Ayah Kandung","2018-02-11");
INSERT INTO tb_ortu VALUES("11","15","12347658101 03","Ilham S","Cilacap","1959-01-29","SLTP","Wiraswasta","Ayah Kandung","2018-02-25");



DROP TABLE tb_pangkat;

CREATE TABLE `tb_pangkat` (
  `id_pangkat` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `pangkat` varchar(64) NOT NULL,
  `gol` varchar(6) NOT NULL,
  `jns_pangkat` varchar(32) NOT NULL,
  `tmt_pangkat` date NOT NULL,
  `pejabat_sk` varchar(32) NOT NULL,
  `no_sk` varchar(32) NOT NULL,
  `tgl_sk` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `status_pan` varchar(5) NOT NULL,
  `jk_pan` varchar(12) NOT NULL,
  PRIMARY KEY (`id_pangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_pangkat VALUES("1","1","Sekretaris","III/A","Struktural","2009-11-01","Andi, SH","1234091090011121","2009-01-01","","","Perempuan");
INSERT INTO tb_pangkat VALUES("2","1","Pembina","III/B","Struktural","2010-11-10","Andi, SH","1234091090000001","2017-01-17","","Aktif","Perempuan");
INSERT INTO tb_pangkat VALUES("3","2","Penata III","III/D","Struktural","2016-02-16","Hatmoko, SH","123400019SK1","2015-03-05","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("4","2","Waka Dinas","III/D","Struktural","2009-01-13","Rjasa, SH","123400019SK0190","2008-07-15","","","");
INSERT INTO tb_pangkat VALUES("5","3","Pengatur","III/A","Struktural","2016-10-04","Andi, ST","123400019SK0191","2016-07-06","","Aktif","Perempuan");
INSERT INTO tb_pangkat VALUES("6","5","Pembina","IV/B","Struktural","2015-06-28","Intan, SH","6761414201","2015-01-27","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("8","5","Penata","III/B","Struktural","2010-01-11","Intan, SH","67614142023","2010-10-26","","","");
INSERT INTO tb_pangkat VALUES("9","4","Penata IV","IV/A","Struktural","2014-12-30","Rajasa, SH","1230901213","2014-01-29","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("10","9","Penata","III/D","Struktural","2012-12-23","Rajasa, SH","12311111213","2012-01-17","","Aktif","Perempuan");
INSERT INTO tb_pangkat VALUES("11","10","Penata","III/C","Struktural","2012-08-01","Rajasa, SH","12309010001","2017-02-13","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("12","6","Anggota","II/A","Struktural","2017-02-01","Rajasa, SH","123090100011","2016-02-09","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("14","8","Anggota","II/A","Struktural","1980-12-30","Rajasa, SH","12309010006","1980-01-07","","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("15","7","Anggota","II/A","Struktural","1981-12-01","Rajasa, SH","12123210001","1981-01-02","","Aktif","Perempuan");
INSERT INTO tb_pangkat VALUES("16","11","Pengatur","II/A","Struktural","2014-02-11","Hatmoko Andi, ST","88881111-SK1","2013-02-13","Daftar Blog Dofollow Instansi dan Pemerintah Auto Approve High PR.pdf","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("17","13","Anggota","III/A","Fungsional","2017-03-08","Rajasa, SH","3273623847464","2017-07-12","Sejarah HTML.pdf","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("18","12","Penata","III/A","Fungsional","2016-02-16","Rajasa, SH","123456331","2015-04-08","Daftar Blog Dofollow Instansi dan Pemerintah Auto Approve High PR.pdf","Aktif","Perempuan");
INSERT INTO tb_pangkat VALUES("19","14","Penata","III/A","Fungsional","2016-01-02","Rajasa , SH","12345671861","2016-02-02","Sejarah HTML.pdf","Aktif","Laki-laki");
INSERT INTO tb_pangkat VALUES("20","15","Penata Muda","III/A","Struktural","2018-01-02","Hatmoko, MM","1231341-09101","2017-12-01","Apa itu HTML - Hyper Text Markup Language.pdf","Aktif","Perempuan");



DROP TABLE tb_pegawai;

CREATE TABLE `tb_pegawai` (
  `id_peg` int(11) NOT NULL,
  `nip` varchar(24) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tempat_lhr` varchar(64) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `agama` varchar(16) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `gol_darah` varchar(2) NOT NULL,
  `status_nikah` varchar(16) NOT NULL,
  `status_kepeg` varchar(8) NOT NULL,
  `tgl_naikpangkat` date NOT NULL,
  `tgl_naikgaji` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `email` varchar(64) NOT NULL,
  `unit_kerja` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tgl_pensiun` date NOT NULL,
  `date_reg` date NOT NULL,
  `urut_pangkat` varchar(6) NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `jabatan` varchar(64) NOT NULL,
  `sekolah` varchar(16) NOT NULL,
  `status_mut` varchar(255) NOT NULL,
  PRIMARY KEY (`id_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_pegawai VALUES("1","19871010 201001 1 001","Rina Maulana","Bogor","1987-03-17","Islam","Perempuan","A","Nikah","PNS","2014-01-22","2016-01-02","Jl. Raya Bogor 776","021009010111","rina@gmail.com","3","9.jpg","2045-03-17","2017-01-19","III/B","Pembina","Staff","SMA","");
INSERT INTO tb_pegawai VALUES("2","19761019 201001 1 001","Ibrahim","Bandung","1976-10-19","Islam","Laki-laki","AB","Nikah","PNS","2016-12-06","2016-12-21","Jl. Bandung","093483081411","ibrahim@email.com","1","","2034-10-19","2017-01-19","III/D","","Kepala Seksi","S1","");
INSERT INTO tb_pegawai VALUES("3","19761010 201001 1 001","Sumaryam","Kebumen","1976-10-15","Islam","Perempuan","AB","Nikah","PNS","2017-01-04","2017-01-03","Jl. Kebumen 88","086777777411","maryam@email.com","7","1.jpg","2034-10-15","2017-01-19","III/A","","Waka Seksi","D3","");
INSERT INTO tb_pegawai VALUES("4","19840610 201001 1 001","Abraham","Medan","1984-06-12","Islam","Laki-laki","A","Nikah","PNS","2016-11-27","2016-10-30","Jl. Medan 001","082183081411","abraham@eamail.com","2","","2042-06-12","2017-01-19","IV/A","","Waka Dinas","S1","");
INSERT INTO tb_pegawai VALUES("5","19881010 201001 1 001","Rajasa Hatmoko, SH","Cilacap","1980-06-30","Islam","Laki-laki","O","Nikah","PNS","2017-01-01","2017-01-24","Jl. Raya Cilacap No. 20 ","085714058786","rajasa@email.com","7","profile-pic.jpg","2038-06-30","2017-01-24","IV/B","","Kepala Dinas","S1","");
INSERT INTO tb_pegawai VALUES("6","19591210 201001 1 001","Darno","Jombang","1959-12-16","Islam","Laki-laki","A","Nikah","PNS","2014-06-03","2016-07-12","Jl. Raya Jombang","089010191019","darno@email.com","3","","2017-12-16","2017-01-25","II/A","","Staff","SMK","");
INSERT INTO tb_pegawai VALUES("7","19600310 201001 1 001","Yatmi","Purworejo","1960-03-09","Islam","Perempuan","A","Nikah","PNS","2016-12-06","2016-12-14","Jl. Raya Purworejo 88","089019158786","yatmi@email.com","6","11.jpg","2018-03-09","2017-01-25","II/A","","Staff","SMP","");
INSERT INTO tb_pegawai VALUES("8","19610510 201001 1 001","Abdul K","Pati","1961-05-22","Islam","Laki-laki","A","Nikah","PNS","2016-12-07","2016-11-30","Jl. Raya pati timur 90","089109101186","abdul@email.com","2","","2019-05-22","2017-01-25","II/A","","Staff","SMK","");
INSERT INTO tb_pegawai VALUES("9","19730610 201001 1 001","Asmiranda","Tegal","1973-06-03","Islam","Perempuan","A","Nikah","PNS","2015-01-27","2015-01-21","Jl. Raya tegal selatan No. 20 RT.02/3","082109001100","armiranda@email.com","3","9.jpg","2031-06-03","2017-02-21","III/D","Penata","Kepala Seksi","D3","");
INSERT INTO tb_pegawai VALUES("10","19750310 201001 1 001","Rahmawati","Banyumas","1975-03-04","Islam","Perempuan","A","Nikah","PNS","2017-02-01","2017-01-04","Jl. Teguh karya 7 No. 33","035109001900","wati@email.com","3","","2033-03-04","2017-02-21","III/C","","Waka Seksi","D3","");
INSERT INTO tb_pegawai VALUES("11","19700810 201001 1 001","Jumadi","Surakarta","1970-08-03","Islam","Laki-laki","O","Nikah","PNS","2017-01-01","2016-01-31","Jl. Raya surakarta 7 No. 111","0251090011","jumadi@email.com","3","no-avatar.jpg","2028-08-03","2017-02-21","II/A","Pengatur","Staff","S1","");
INSERT INTO tb_pegawai VALUES("12","19771010 201001 1 001","Hamaida Saraswati","Sidoarjo","1977-10-10","Hindu","Perempuan","AB","Nikah","PNS","2014-01-02","2015-01-02","Jl. Gedangan Panjang XII No 121 , Cilacap","012345612344","saraswati@email.com","3","10.jpg","2035-10-10","2018-02-08","III/A","Penata","Staff","D3","");
INSERT INTO tb_pegawai VALUES("13","19870608 201001 1 007","Hardiansyah","Boyolali","1987-05-08","Islam","Laki-laki","AB","Nikah","PNS","2014-02-28","2016-02-27","Jl. Kusuma Bangsa","012345612344","hardia@email.com","1","","2045-05-08","2018-02-10","III/A","Anggota","Staff","S1","");
INSERT INTO tb_pegawai VALUES("14","19860630 201001 1 009","Aryasatya BN","Cilacap","1986-06-30","Islam","Laki-laki","O","Nikah","PNS","2014-02-02","2014-02-02","Jl. Raya Pesanggraan No. 20","085714057686","hatmoko@email.com","1","","2044-06-30","2018-02-11","III/A","Penata","Pengawas","S1","");
INSERT INTO tb_pegawai VALUES("15","19850630 201001 1 002","Ratnasari P","Bandung","1985-06-30","Islam","Perempuan","AB","Nikah","PNS","2016-03-31","2014-03-31","Bandung Raya X No. 190","098909809811","ratna@email.com","13","11.jpg","2043-06-30","2018-02-25","III/A","Penata Muda","Sekretaris","S1","");



DROP TABLE tb_penghargaan;

CREATE TABLE `tb_penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `penghargaan` varchar(64) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `pemberi` varchar(64) NOT NULL,
  PRIMARY KEY (`id_penghargaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_penghargaan VALUES("1","1","Pegawai Teladan","2014","Dinas Pengadilan Tinggi");
INSERT INTO tb_penghargaan VALUES("2","5","Pegawai Disiplin","2005","Pengadilan Tinggi");
INSERT INTO tb_penghargaan VALUES("3","11","Pegawai Disiplin","2009","Dinas Kependudukan");
INSERT INTO tb_penghargaan VALUES("4","14","Arguna Raya Jipa","2016","RSUD Malang");
INSERT INTO tb_penghargaan VALUES("5","15","Asisten Terbaik","2010","Indonesia");



DROP TABLE tb_penugasan;

CREATE TABLE `tb_penugasan` (
  `id_penugasan` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `tujuan` varchar(32) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `lama` varchar(3) NOT NULL,
  `alasan` varchar(128) NOT NULL,
  PRIMARY KEY (`id_penugasan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_penugasan VALUES("1","1","Australia","2011","14","Kongres K3");
INSERT INTO tb_penugasan VALUES("2","9","China","2006","14","Studi Banding");
INSERT INTO tb_penugasan VALUES("3","11","India","2014","7","Duta Teknologi");
INSERT INTO tb_penugasan VALUES("4","14","India","2014","14","Duta Seni dan Budaya");
INSERT INTO tb_penugasan VALUES("5","15","Rusia","2015","14","Duta Pendidikan");



DROP TABLE tb_sekolah;

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `tingkat` varchar(16) NOT NULL,
  `nama_sekolah` varchar(64) NOT NULL,
  `lokasi` varchar(32) NOT NULL,
  `jurusan` varchar(32) NOT NULL,
  `no_ijazah` varchar(32) NOT NULL,
  `tgl_ijazah` date NOT NULL,
  `kepala` varchar(64) NOT NULL,
  `status` varchar(5) NOT NULL,
  `gol` varchar(6) NOT NULL,
  `pangkat` varchar(32) NOT NULL,
  `eselon` varchar(16) NOT NULL,
  PRIMARY KEY (`id_sekolah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_sekolah VALUES("1","1","SD","SD N Panji 2","Panji","-","120910918628","1995-02-01","Rajasa, SH","","","","");
INSERT INTO tb_sekolah VALUES("2","1","SMP","SLTP N 1 Palolo","Palolo1","-","120910918628101","1998-10-06","Andi, ST","","","","");
INSERT INTO tb_sekolah VALUES("3","1","SMA","SLTA N 2 Palolo","Palolo","IPA","1209109186280191","2001-03-14","Andi, ST","Akhir","II/D","Pengatur","III/d");
INSERT INTO tb_sekolah VALUES("4","5","S1","Universitas Hatmoko","Cilacap","IT","12345TYH0190191","2012-01-09","Juniaidi, SH","Akhir","IV/B","Pembina","IV/B");
INSERT INTO tb_sekolah VALUES("5","2","S1","Universitas Hatmoko","Cilacap","Ekonomi","12345TYH0190193","2011-06-21","Juniaidi, SH","Akhir","III/D","Kepala Dinas","III/b");
INSERT INTO tb_sekolah VALUES("6","4","S1","UGM","Jogjakarta","Statitik","1234091011","1999-07-07","Rajasa, SH","Akhir","IV/A","Pembina","IV/A");
INSERT INTO tb_sekolah VALUES("7","9","D3","UIN","Cilacap","Teknik Informatika","1234091012","2010-02-02","Rajasa, SH","Akhir","III/D","Penata","III/d");
INSERT INTO tb_sekolah VALUES("8","10","D3","UINA","Cilacap","Statitik","1234091014","2007-07-24","Rajasa, SH","Akhir","III/C","Penata","III/c");
INSERT INTO tb_sekolah VALUES("9","3","D3","UINA","Cilacap","Statitik","1234091011","2000-02-01","Rajasa, SH","Akhir","III/A","Waka Dinas","III/c");
INSERT INTO tb_sekolah VALUES("11","6","SMK","SMK N 1 ","Cilacap","Bangunan","13221191011","1998-05-13","Rajasa, SH","Akhir","II/A","Anggota","II/b");
INSERT INTO tb_sekolah VALUES("12","8","SMK","SMK N 1","Jogjakarta","Teknik Mesin","1234091011","1998-01-13","Rajasa, SH","Akhir","","","");
INSERT INTO tb_sekolah VALUES("13","7","SMP","SLTP N 1","Banyumas","","1234091012","1966-07-14","Rajasa, SH","Akhir","II/A","Anggota","II/b");
INSERT INTO tb_sekolah VALUES("14","11","S1","UINA","Surabaya","Teknik Informatika","123456171626-Z1","2002-03-06","Hatmoko Andi , ST","Akhir","II/A","Anggota","II/b");
INSERT INTO tb_sekolah VALUES("15","13","S1","Airlangga Satria","Surabaya","Ilmu Hukum","56566455569","2014-03-12","Rajasa, SH","Akhir","","","");
INSERT INTO tb_sekolah VALUES("16","12","D3","Ujayana","Bandung","Ilmu Ekonomi Islam","12345678771","2003-03-12","Sutrisna G","Akhir","","","");
INSERT INTO tb_sekolah VALUES("17","14","S1","Udayana","Bandung","TI","4342530904988","2011-03-16","Hatmoko, ST","Akhir","","","");
INSERT INTO tb_sekolah VALUES("18","15","SMA","SMA N 7 Bandung","Bandung","IPA","12345091","1997-06-17","Hatmoko, MM","","","","");
INSERT INTO tb_sekolah VALUES("19","15","S1","Gunajaya Raya","Surakarta","Hukum Tata Negara","123450914","2004-07-14","Hatmoko, MM","Akhir","","","");



DROP TABLE tb_seminar;

CREATE TABLE `tb_seminar` (
  `id_seminar` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `seminar` varchar(128) NOT NULL,
  `tempat` varchar(32) NOT NULL,
  `penyelenggara` varchar(64) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `no_piagam` varchar(32) NOT NULL,
  `tgl_piagam` date NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id_seminar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_seminar VALUES("1","1","Seminar Online Program","Gedung Patra II","Kominfo","2017-01-03","2017-01-10","123450002","2017-01-23","1. Blank Format.docx");
INSERT INTO tb_seminar VALUES("2","9","Seminar K3 A","Gedung III PU","DPU","2017-02-01","2017-02-14","12356101","2017-02-21","");
INSERT INTO tb_seminar VALUES("3","11","P3K","Bandung","Dinas Kesehatan","2017-12-01","2017-12-14","3625711-S1","2017-12-15","Apa itu HTML - Hyper Text Markup Language.pdf");
INSERT INTO tb_seminar VALUES("4","14","Kewirausahaan","Cilacap","Dinas Ketenagakerjaan","2017-06-01","2017-06-10","1123832617","2017-11-29","Daftar Blog Dofollow Instansi dan Pemerintah Auto Approve High PR.pdf");
INSERT INTO tb_seminar VALUES("5","15","Pelatihan ERT","Jakarta","Disnakertrans","2017-02-06","2017-02-15","6562509-101","2018-01-11","Cara Melakukan Ping Website Blog.pdf");



DROP TABLE tb_setup_bkd;

CREATE TABLE `tb_setup_bkd` (
  `id_setup_bkd` int(11) NOT NULL,
  `kab` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kepala` int(11) NOT NULL,
  PRIMARY KEY (`id_setup_bkd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_setup_bkd VALUES("1","Cilacap","Jl. Raya Pesanggrahan XII No. 201 Telp. 768621,768622 Fax. 768621","5");



DROP TABLE tb_setup_sekda;

CREATE TABLE `tb_setup_sekda` (
  `id_setup_sekda` int(11) NOT NULL,
  `kab` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `sekda` int(11) NOT NULL,
  PRIMARY KEY (`id_setup_sekda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_setup_sekda VALUES("1","Cilacap","Jl. Garuda Raya IX No. 44 Telp. 123451, 123452 Fax. 123451","9");



DROP TABLE tb_skp;

CREATE TABLE `tb_skp` (
  `id_skp` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `penilai` varchar(64) NOT NULL,
  `atasan_penilai` varchar(64) NOT NULL,
  `nilai_orientasi` double NOT NULL,
  `nilai_integritas` double NOT NULL,
  `nilai_komitmen` double NOT NULL,
  `nilai_disiplin` double NOT NULL,
  `nilai_kerjasama` double NOT NULL,
  `nilai_kepemimpinan` double NOT NULL,
  `hasil_penilaian` varchar(12) NOT NULL,
  PRIMARY KEY (`id_skp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_skp VALUES("1","1","2015-01-02","2015-12-31","Rajasa H, ST","Hatmoko, ST","7.9","6.7","7.8","7.9","8.2","9.4","Baik");
INSERT INTO tb_skp VALUES("2","2","2015-01-02","2015-12-31","Rajasa H, ST","Hatmoko, ST","7.1","6.2","6.8","6.9","6.2","7.4","Cukup Baik");
INSERT INTO tb_skp VALUES("3","3","2016-01-02","2016-12-31","Rajasa H, ST","Hatmoko, ST","7.11","6.81","6.11","6.21","6.61","6.41","Cukup Baik");
INSERT INTO tb_skp VALUES("4","4","2016-01-01","2016-12-31","Ahmad","Rajasa","8","7.5","7.1","7","8.4","8","Sangat Baik");
INSERT INTO tb_skp VALUES("5","9","2016-01-01","2016-12-31","Ahmad","Abraham","6.7","7","7.4","7","6.7","7.8","Baik");
INSERT INTO tb_skp VALUES("6","10","2016-01-01","2016-12-31","Ahmad","Abraham","6.7","7.5","7.1","7","6.7","7","Baik");
INSERT INTO tb_skp VALUES("7","7","2016-01-01","2016-12-31","Ahmad H","Abraham H","6.7","6","6.5","6.2","6","5","Cukup Baik");
INSERT INTO tb_skp VALUES("8","11","2016-01-01","2016-12-31","Andi","Abraham H","6.7","6","6.5","6.2","6","5","Cukup Baik");
INSERT INTO tb_skp VALUES("9","5","2017-01-02","2017-12-31","Ishabudin LAG","Rohmat IGO","74","76","69","73","82","77","Baik");
INSERT INTO tb_skp VALUES("10","12","2017-01-02","2017-12-31","Rajasa Hatmoko","Hatmoko","78","74","69","66","65","72","Baik");
INSERT INTO tb_skp VALUES("11","13","2017-01-02","2017-12-31","Rajasa Hatmoko","Hatmoko","67","66","73","69","71","64","Cukup Baik");
INSERT INTO tb_skp VALUES("12","14","2016-01-02","2016-12-31","Hatmoko","Andi Hatmoko","67","65","71","68","75","66","Cukup Baik");
INSERT INTO tb_skp VALUES("13","15","2017-01-02","2017-12-31","Hatmoko, MM","Rajasa, SH","67","56","78","72","65","59","Cukup Baik");



DROP TABLE tb_spkgb;

CREATE TABLE `tb_spkgb` (
  `id_spkgb` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `no_kgb` varchar(32) NOT NULL,
  `tgl` date NOT NULL,
  `pejabat_lama` varchar(255) NOT NULL,
  `no_lama` varchar(32) NOT NULL,
  `tgl_lama` date NOT NULL,
  `tgl_berlaku_lama` date NOT NULL,
  `mk_lama` varchar(32) NOT NULL,
  `gaji_lama` double NOT NULL,
  `gaji_baru` double NOT NULL,
  `terbilang_gajibaru` varchar(255) NOT NULL,
  `mk_baru` varchar(32) NOT NULL,
  `gol_baru` varchar(32) NOT NULL,
  `tgl_terhitung` date NOT NULL,
  `tembusan1` varchar(255) NOT NULL,
  `tembusan2` varchar(255) NOT NULL,
  `tembusan3` varchar(255) NOT NULL,
  `tembusan4` varchar(255) NOT NULL,
  `tembusan5` varchar(255) NOT NULL,
  `tembusan6` varchar(255) NOT NULL,
  `tembusan7` varchar(255) NOT NULL,
  `tembusan8` varchar(255) NOT NULL,
  `tembusan9` varchar(255) NOT NULL,
  `tembusan10` varchar(255) NOT NULL,
  `tembusan11` varchar(255) NOT NULL,
  `tembusan12` varchar(255) NOT NULL,
  PRIMARY KEY (`id_spkgb`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_spkgb VALUES("1","1","822.3/60","2018-01-06","Bupati Cilacap","822.3/50","2017-02-15","2017-02-08","02 Thn 00 Bln","1954900","2326300","Dua juta tiga ratus dua puluh enam ribu tiga ratus rupiah","04 Tahun 00 Bulan","III/A","2018-03-14","Menteri Dalam Negeri di Jakarta ;","Ketua Badan Pemeriksa Keuangan di Jakarta ;","Kepala Badan Kepegawaian Negara di Jakarta ;","Kepala Biro Tata Usaha Kepegawaian BKN di Jakarta ;","Kepala Kantor Regional IX BKN di Semarang ;","Tembusan F;","Tembusan G;","Tembusan H;","Kepala Badan Kepegawaian Daerah Kabupaten Cialcap;","Bend/Juru Bayar pada Badan Kepegawaian Daerah Kabupaten Cilacap;","Yang bersangkutan untuk diketahui ;","Arsip.");
INSERT INTO tb_spkgb VALUES("2","11","822.3/61","2018-12-09","Bupati Cilacap","822.3/51","2018-01-02","2018-01-31","02 Thn 00 Bln","1925700","2426300","Dua juta empat ratus dua puluh enam ribu tiga ratus rupiah","04 Tahun 00 Bulan","III/B","2018-02-02","Tembusan A","Tembusan B","Tembusan C","Tembusan D","Tembusan E","Tembusan F","Tembusan G","Tembusan H","Tembusan I","Tembusan J","Tembusan K","Tembusan L");
INSERT INTO tb_spkgb VALUES("3","13","857.2121-01","2018-01-02","Bupati Cilacap","746643721","2018-02-10","2018-01-02","02 Thn 00 Bln","1925700","2526300","Dua juta lima ratus dua puluh enam ribu tiga ratus rupiah","04 Tahun 00 Bulan","II/C","2018-01-02","Tembusan A","Tembusan B","Tembusan C","Tembusan D","Tembusan E","Tembusan F","Tembusan G","Tembusan H","Tembusan I","Tembusan J","Tembusan K","Tembusan L");
INSERT INTO tb_spkgb VALUES("4","14","825.3/61","2018-02-01","Andrea AA, S.Kom","822.3/50","2016-01-18","2018-01-02","02 Thn 00 Bln","2254900","3326300","Tiga juta tiga ratus dua puluh enam ribu tiga ratus rupiah","04 Tahun 00 Bulan","III/A","2018-01-02","Tembusan 1","Tembusan 2","Tembusan 3","Tembusan 4","Tembusan 5"," Tembusan 6","Tembusan 7","Tembusan 8","Tembusan 9","Tembusan 10","Tembusan 11","Tembusan 12");



DROP TABLE tb_suamiistri;

CREATE TABLE `tb_suamiistri` (
  `id_si` int(11) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tmp_lhr` varchar(64) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `pendidikan` varchar(8) NOT NULL,
  `pekerjaan` varchar(32) NOT NULL,
  `status_hub` varchar(8) NOT NULL,
  `date_reg` date NOT NULL,
  PRIMARY KEY (`id_si`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_suamiistri VALUES("1","4","1201019090111212","Ishita","Palembang","1990-12-16","D3","Karyawan","Istri","2017-01-19");
INSERT INTO tb_suamiistri VALUES("2","1","1201019090111019","Abdulla","Sragen","1980-09-01","SLTA","Karyawan","Suami","2017-01-21");
INSERT INTO tb_suamiistri VALUES("3","3","1201019090111211","Nandang S","Palembang","1988-06-01","D3","Wiraswasta","Suami","2017-01-21");
INSERT INTO tb_suamiistri VALUES("4","5","3201092029171910","Intania","Cilacap","1986-07-16","D3","Wiraswasta","Istri","2017-01-24");
INSERT INTO tb_suamiistri VALUES("5","9","3301017487210002","Anton K","Majalengka","1979-11-28","D3","Karyawan","Suami","2017-02-21");
INSERT INTO tb_suamiistri VALUES("6","10","3301070017210001","Budiawan J","Cirebon","1975-06-01","SLTA","Karyawan","Suami","2017-02-21");
INSERT INTO tb_suamiistri VALUES("7","2","3101010001210001","Aminah","Bojonegoro","1975-01-13","SLTA","-","Istri","2017-02-21");
INSERT INTO tb_suamiistri VALUES("9","6","1234567890101010","Sarinah","Kebumen","1968-12-29","SLTP","-","Istri","2017-12-13");
INSERT INTO tb_suamiistri VALUES("10","11","1234567890101111","Sitiah K","Kebumen","1977-11-08","SLTP","-","Istri","2017-12-13");
INSERT INTO tb_suamiistri VALUES("11","13","320108348464001","Safila L","Jakarta","1989-02-28","D3","-","Istri","2018-02-11");
INSERT INTO tb_suamiistri VALUES("12","12","3201020002183922","Kurniawan","Malang","1976-08-12","SLTA","Karyawan","Suami","2018-02-11");
INSERT INTO tb_suamiistri VALUES("13","14","52425425241691","Aisyah","Bandung","1988-07-09","D3","-","Istri","2018-02-11");
INSERT INTO tb_suamiistri VALUES("14","15","12347658101 01","Budiman L","Jakarta","1983-07-09","D3","PNS","Suami","2018-02-25");



DROP TABLE tb_tunjangan;

CREATE TABLE `tb_tunjangan` (
  `id_tunjangan` int(11) NOT NULL,
  `no_tunjangan` varchar(32) NOT NULL,
  `tgl_tunjangan` date NOT NULL,
  `id_peg` int(11) NOT NULL,
  `jns_tunjangan` varchar(32) NOT NULL,
  `tgl_terhitung` date NOT NULL,
  `akta_kawin` varchar(255) NOT NULL,
  `no_akta_kawin` varchar(32) NOT NULL,
  `tgl_akta_kawin` date NOT NULL,
  `akta_lahir` varchar(255) NOT NULL,
  `no_akta_lahir` varchar(32) NOT NULL,
  `tgl_akta_lahir` date NOT NULL,
  `tembusan1` varchar(255) NOT NULL,
  `tembusan2` varchar(255) NOT NULL,
  `tembusan3` varchar(255) NOT NULL,
  `tembusan4` varchar(255) NOT NULL,
  `tembusan5` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tunjangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_tunjangan VALUES("1","841.6/ 01 / FF/2011","2018-01-04","11","Anak Pertama","2018-01-10","Dinas Kependudukan dan Pencatatan Sipil Kota Kupang","681/DKPS/KK/2009","2016-03-09","Dinas Kependudukan dan Pencatatan Sipil Kabupaten Fakfak","9203-LU-27062011-0002","2018-03-14","Kepala Dinas Pekerjaan Umum Kabupaten Fakfak;","Kepala Badan Kepegawaian Daerah Kabupaten Fakfak di Fakfak;","Bendaharawan / Juru Bayar pada Dinas Pekerjaan Umum Kabupaten Fakfak;","Yang bersangkutan untuk diketahui;","Arsip");
INSERT INTO tb_tunjangan VALUES("2","841.6/ 02 / FF/2011","2018-01-12","8","Anak Kedua","2018-01-19","Dinas Kependudukan dan Pencatatan Sipil Kota Kupang","681/DKPS/KK/2006","2018-03-06","Dinas Kependudukan dan Pencatatan Sipil Kabupaten Kupang","9203-LU-27062011-0002","2017-02-07","Tembusan A","Tembusan B","Tembusan C","Tembusan D","Tembusan E");
INSERT INTO tb_tunjangan VALUES("3","21231241212301","2016-02-16","13","Anak Pertama","2017-01-02","Dinas Kependudukan dan Pencatatan Sipil Kota Bekasi","123213142888","2015-01-05","Dinas Kependudukan dan Pencatatan Sipil Kabupaten Bekasi","21321141777","2016-03-01","Tembusan A","Tembusan B","Tembusan C","Tembusan D","Tembusan E");
INSERT INTO tb_tunjangan VALUES("4","841.6/ 01 / CLP/2011","2018-02-01","15","Anak Pertama","2018-01-02","Dinas Kependudukan dan Pencatatan Sipil","681/DKPS/KK/2009","2017-06-13","Dinas Kependudukan dan Pencatatan Sipil","9203-LU-27062011-0001","2018-01-02","Tembusan 1","Tembusan 2","Tembusan 3","Tembusan 4","Tembusan 5");



DROP TABLE tb_unit;

CREATE TABLE `tb_unit` (
  `id_unit` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_unit VALUES("1","Pemerintah Kabupaten Cilacap");
INSERT INTO tb_unit VALUES("2","Sekretariat Daerah Kabupaten Cilacap");
INSERT INTO tb_unit VALUES("3","Sekretariat DPRD");
INSERT INTO tb_unit VALUES("4","Sekretariat Komisi Pemilihan Umum");
INSERT INTO tb_unit VALUES("5","Inspektorat");
INSERT INTO tb_unit VALUES("6","Badan Kepegawaian Daerah");
INSERT INTO tb_unit VALUES("7","Badan Penanggulangan Bencana Daerah");
INSERT INTO tb_unit VALUES("8","Badan Pelayanan Pajak Daerah");
INSERT INTO tb_unit VALUES("9","Badan Pengelolaan Keuangan Dan Aset Daerah");
INSERT INTO tb_unit VALUES("10","Dinas Lingkungan Hidup Dan Kebersihan");
INSERT INTO tb_unit VALUES("11","Dinas Perikanan");
INSERT INTO tb_unit VALUES("12","Dinas Kependudukan Dan Pencatatan Sipil");
INSERT INTO tb_unit VALUES("13","Dinas Kesehatan");
INSERT INTO tb_unit VALUES("14","Dinas Koperasi Dan Usaha Mikro");
INSERT INTO tb_unit VALUES("15","Dinas Pekerjaan Umum Dan Penataan Ruang");
INSERT INTO tb_unit VALUES("16","Dinas Perumahan Dan Permukiman");
INSERT INTO tb_unit VALUES("17","Dinas Komunikasi Dan Informatika");
INSERT INTO tb_unit VALUES("18","Dinas Pariwisata Dan Kebudayaan");



DROP TABLE tb_user;

CREATE TABLE `tb_user` (
  `id_user` varchar(32) NOT NULL,
  `nama_user` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(16) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `id_peg` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_peg` (`id_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_user VALUES("19591210 201001 1 001","Darno","202cb962ac59075b964b07152d234b70","Pegawai","","6");
INSERT INTO tb_user VALUES("19600310 201001 1 001","Yatmi","202cb962ac59075b964b07152d234b70","Pegawai","","7");
INSERT INTO tb_user VALUES("19610510 201001 1 001","Adul K","202cb962ac59075b964b07152d234b70","Pegawai","","8");
INSERT INTO tb_user VALUES("19700810 201001 1 001","Jumadi","202cb962ac59075b964b07152d234b70","Pegawai","","11");
INSERT INTO tb_user VALUES("19730610 201001 1 001","Asmiranda","202cb962ac59075b964b07152d234b70","Pegawai","","9");
INSERT INTO tb_user VALUES("19750310 201001 1 001","Rahmawati","202cb962ac59075b964b07152d234b70","Pegawai","","10");
INSERT INTO tb_user VALUES("19761010 201001 1 001","Sumaryam","202cb962ac59075b964b07152d234b70","Pegawai","","3");
INSERT INTO tb_user VALUES("19761019 201001 1 001","Ibrahim","202cb962ac59075b964b07152d234b70","Pegawai","","2");
INSERT INTO tb_user VALUES("19771010 201001 1 001","Hamaida Saraswati","202cb962ac59075b964b07152d234b70","Pegawai","","12");
INSERT INTO tb_user VALUES("19840610 201001 1 001","Abraham","202cb962ac59075b964b07152d234b70","Pegawai","","4");
INSERT INTO tb_user VALUES("19850630 201001 1 002","Ratnasari P","202cb962ac59075b964b07152d234b70","Pegawai","","15");
INSERT INTO tb_user VALUES("19860630 201001 1 009","Aryasatya BN","202cb962ac59075b964b07152d234b70","Pegawai","","14");
INSERT INTO tb_user VALUES("19870608 201001 1 007","Hardiansyah","202cb962ac59075b964b07152d234b70","Pegawai","","13");
INSERT INTO tb_user VALUES("19871010 201001 1 001","Rina Maulana","202cb962ac59075b964b07152d234b70","Pegawai","","1");
INSERT INTO tb_user VALUES("19881010 201001 1 001","Rajasa Hatmoko, SH","202cb962ac59075b964b07152d234b70","Pegawai","","5");
INSERT INTO tb_user VALUES("admin","Hamida Pasha","202cb962ac59075b964b07152d234b70","Admin","avatar3.png","0");
INSERT INTO tb_user VALUES("rahma","Rahmawati K","202cb962ac59075b964b07152d234b70","Admin","","0");
INSERT INTO tb_user VALUES("superadmin","Raja Putra Media","202cb962ac59075b964b07152d234b70","Superadmin","","0");



