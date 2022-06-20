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

INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");
INSERT INTO tb_user VALUES("","","","","","");



