/*
 Navicat Premium Data Transfer

 Source Server         : localhost postgres
 Source Server Type    : PostgreSQL
 Source Server Version : 100005
 Source Host           : localhost:5432
 Source Catalog        : dinkop
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 100005
 File Encoding         : 65001

 Date: 10/12/2020 08:24:05
*/


-- ----------------------------
-- Sequence structure for jenis_jaminan_jns_jam_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."jenis_jaminan_jns_jam_id_seq";
CREATE SEQUENCE "public"."jenis_jaminan_jns_jam_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for karyawan_kar_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."karyawan_kar_id_seq";
CREATE SEQUENCE "public"."karyawan_kar_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for member_member_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."member_member_id_seq";
CREATE SEQUENCE "public"."member_member_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for pembayaran_pembayaran_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."pembayaran_pembayaran_id_seq";
CREATE SEQUENCE "public"."pembayaran_pembayaran_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for pengajuan_foto_peng_foto_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."pengajuan_foto_peng_foto_id_seq";
CREATE SEQUENCE "public"."pengajuan_foto_peng_foto_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for pengajuan_peng_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."pengajuan_peng_id_seq";
CREATE SEQUENCE "public"."pengajuan_peng_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_approval_ref_approval_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_approval_ref_approval_id_seq";
CREATE SEQUENCE "public"."ref_approval_ref_approval_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 32767
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_bidang_usaha_ref_bidang_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_bidang_usaha_ref_bidang_id_seq";
CREATE SEQUENCE "public"."ref_bidang_usaha_ref_bidang_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_group_akses_ref_group_akses_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_group_akses_ref_group_akses_id_seq";
CREATE SEQUENCE "public"."ref_group_akses_ref_group_akses_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_jaminan_ref_jaminan_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_jaminan_ref_jaminan_id_seq";
CREATE SEQUENCE "public"."ref_jaminan_ref_jaminan_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_jenis_pengajuan_jns_pengajuan_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_jenis_pengajuan_jns_pengajuan_id_seq";
CREATE SEQUENCE "public"."ref_jenis_pengajuan_jns_pengajuan_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_kecamatan_ref_kec_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_kecamatan_ref_kec_id_seq";
CREATE SEQUENCE "public"."ref_kecamatan_ref_kec_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_kelurahan_ref_kel_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_kelurahan_ref_kel_id_seq";
CREATE SEQUENCE "public"."ref_kelurahan_ref_kel_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_modul_akses_ref_modul_akses_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_modul_akses_ref_modul_akses_id_seq";
CREATE SEQUENCE "public"."ref_modul_akses_ref_modul_akses_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ref_user_akses_ref_user_akses_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ref_user_akses_ref_user_akses_id_seq";
CREATE SEQUENCE "public"."ref_user_akses_ref_user_akses_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for survey_detail_survey_det_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."survey_detail_survey_det_id_seq";
CREATE SEQUENCE "public"."survey_detail_survey_det_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for survey_hasil_survey_hasil_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."survey_hasil_survey_hasil_id_seq";
CREATE SEQUENCE "public"."survey_hasil_survey_hasil_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for survey_survey_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."survey_survey_id_seq";
CREATE SEQUENCE "public"."survey_survey_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for survey_tempat_survey_tem_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."survey_tempat_survey_tem_id_seq";
CREATE SEQUENCE "public"."survey_tempat_survey_tem_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_user_id_seq";
CREATE SEQUENCE "public"."user_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS "public"."karyawan";
CREATE TABLE "public"."karyawan" (
  "kar_id" int4 NOT NULL DEFAULT nextval('karyawan_kar_id_seq'::regclass),
  "kar_nama" varchar COLLATE "pg_catalog"."default",
  "kar_nip" varchar(255) COLLATE "pg_catalog"."default",
  "kar_pangkat" varchar(255) COLLATE "pg_catalog"."default",
  "kar_jabatan" varchar(255) COLLATE "pg_catalog"."default",
  "kar_created_at" timestamp(6),
  "kar_created_by" int4,
  "kar_visible" bool
)
;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO "public"."karyawan" VALUES (2, 'HUSNAWATI,S.Sos', '19751120 199803 2 003', 'Penata /IIIc', 'Staf P3KUM', '2020-11-20 09:47:41.15766', 1, 't');
INSERT INTO "public"."karyawan" VALUES (1, 'PATRIA HADI WIJAYA,SH', '19820915 200312 1 004', 'Penata Muda Tk I / III b', 'kasi Pembiayaan Koperasi Dan Usaha Mikro P3KUM', '2020-11-20 09:45:15.042906', 1, 't');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS "public"."member";
CREATE TABLE "public"."member" (
  "member_id" int4 NOT NULL DEFAULT nextval('member_member_id_seq'::regclass),
  "member_nama_lengkap" varchar COLLATE "pg_catalog"."default",
  "member_alamat" varchar(255) COLLATE "pg_catalog"."default",
  "member_no_telp" varchar(255) COLLATE "pg_catalog"."default",
  "member_kelurahan" int4,
  "member_created_at" timestamp(6),
  "member_created_by" int4,
  "member_updated_by" int4,
  "member_updated_at" timestamp(6),
  "member_visible" bool DEFAULT true,
  "member_no_ktp" varchar(255) COLLATE "pg_catalog"."default",
  "member_pekerjaan" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO "public"."member" VALUES (18, 'yusuf', 'kediri', '0988', 2, '2020-10-24 09:56:41.298859', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."member" VALUES (32, 'mohammad almi kurniawan', 'kediri', '08765432', 3, '2020-11-06 15:08:25.827111', NULL, NULL, NULL, 't', NULL, NULL);
INSERT INTO "public"."member" VALUES (17, 'yusuf', 'kediri', '0858585', 4, '2020-10-23 15:48:26.280736', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."member" VALUES (33, 'yusuf', 'kediri', '0858585', NULL, '2020-12-08 14:27:16.844868', NULL, NULL, NULL, 't', NULL, NULL);
INSERT INTO "public"."member" VALUES (34, 'ari', 'kediri', '0858585', NULL, '2020-12-08 14:32:26.895413', NULL, NULL, NULL, 't', NULL, NULL);
INSERT INTO "public"."member" VALUES (35, 'almi kurniawan', 'kediri', '0875463545', NULL, '2020-12-09 08:27:33.959045', NULL, NULL, NULL, 't', NULL, NULL);
INSERT INTO "public"."member" VALUES (36, 'almi kurniawan', 'kediri', '0856657647', 33, '2020-12-09 09:00:58.509572', NULL, NULL, NULL, 't', '350687857476', 'Swasta');
INSERT INTO "public"."member" VALUES (37, 'Anis Fahmi', 'Kediri', '0857646546', 33, '2020-12-10 08:18:37.93483', NULL, NULL, NULL, 't', '350698682638423', 'Swasta');

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS "public"."pembayaran";
CREATE TABLE "public"."pembayaran" (
  "pembayaran_id" int4 NOT NULL DEFAULT nextval('pembayaran_pembayaran_id_seq'::regclass),
  "pembayaran_peng_id" int4,
  "pembayaran_tanggal" date,
  "pembayaran_cicilan" int4,
  "pembayaran_ke" int4,
  "pembayaran_lunas_is" bool,
  "pembayaran_lunas_tanggal" date
)
;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------
INSERT INTO "public"."pembayaran" VALUES (203, 15, '2020-12-08', 100000, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (204, 15, '2021-01-08', 100000, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (205, 15, '2021-02-08', 100000, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (206, 15, '2021-03-08', 100000, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (207, 15, '2021-04-08', 100000, 5, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (208, 15, '2021-05-08', 100000, 6, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (209, 15, '2021-06-08', 100000, 7, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (210, 15, '2021-07-08', 100000, 8, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (211, 15, '2021-08-08', 100000, 9, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (212, 15, '2021-09-08', 100000, 10, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (213, 16, '2020-12-08', 1000000, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (214, 16, '2021-01-08', 1000000, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (215, 16, '2021-02-08', 1000000, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (216, 16, '2021-03-08', 1000000, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (217, 16, '2021-04-08', 1000000, 5, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (218, 16, '2021-05-08', 1000000, 6, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (219, 16, '2021-06-08', 1000000, 7, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (220, 16, '2021-07-08', 1000000, 8, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (221, 16, '2021-08-08', 1000000, 9, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (222, 16, '2021-09-08', 1000000, 10, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (223, 16, '2021-10-08', 1000000, 11, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (224, 16, '2021-11-08', 1000000, 12, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (225, 19, '2020-12-10', 12, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (226, 19, '2021-01-10', 12, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (227, 19, '2021-02-10', 12, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (228, 19, '2021-03-10', 12, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (229, 19, '2021-04-10', 12, 5, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (230, 19, '2021-05-10', 12, 6, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (231, 19, '2021-06-10', 12, 7, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (232, 19, '2021-07-10', 12, 8, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (233, 19, '2021-08-10', 12, 9, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (234, 19, '2021-09-10', 12, 10, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (235, 19, '2021-10-10', 12, 11, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (236, 19, '2021-11-10', 12, 12, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (237, 18, '2020-12-10', 1000000, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (238, 18, '2021-01-10', 1000000, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (239, 18, '2021-02-10', 1000000, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (240, 18, '2021-03-10', 1000000, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (241, 18, '2021-04-10', 1000000, 5, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (242, 18, '2021-05-10', 1000000, 6, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (243, 18, '2021-06-10', 1000000, 7, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (244, 18, '2021-07-10', 1000000, 8, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (245, 18, '2021-08-10', 1000000, 9, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (246, 18, '2021-09-10', 1000000, 10, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (247, 18, '2021-10-10', 1000000, 11, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (248, 18, '2021-11-10', 1000000, 12, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (261, 21, '2020-12-08', 100000, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (262, 21, '2021-01-08', 100000, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (263, 21, '2021-02-08', 100000, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (264, 21, '2021-03-08', 100000, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (265, 21, '2021-04-08', 100000, 5, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (266, 21, '2021-05-08', 100000, 6, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (267, 21, '2021-06-08', 100000, 7, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (268, 21, '2021-07-08', 100000, 8, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (269, 21, '2021-08-08', 100000, 9, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (270, 21, '2021-09-08', 100000, 10, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (271, 21, '2021-10-08', 100000, 11, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (272, 21, '2021-11-08', 100000, 12, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (273, 22, '2020-12-10', 1000000, 1, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (274, 22, '2021-01-10', 1000000, 2, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (275, 22, '2021-02-10', 1000000, 3, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (276, 22, '2021-03-10', 1000000, 4, NULL, NULL);
INSERT INTO "public"."pembayaran" VALUES (277, 22, '2021-04-10', 1000000, 5, NULL, NULL);

-- ----------------------------
-- Table structure for pengajuan
-- ----------------------------
DROP TABLE IF EXISTS "public"."pengajuan";
CREATE TABLE "public"."pengajuan" (
  "peng_id" int4 NOT NULL DEFAULT nextval('pengajuan_peng_id_seq'::regclass),
  "peng_tanggal" date,
  "peng_bidang_usaha" int4,
  "peng_jenis_pengajuan" int2,
  "peng_tujuan_penggunaan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_foto_suami" varchar(255) COLLATE "pg_catalog"."default",
  "peng_foto_istri" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_ktp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_kk" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_surat_nikah" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_legalitas_jaminan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_member_id" int4,
  "peng_nominal" float8,
  "peng_prof_nama_usaha" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_alamat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_pimpinan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_perizinan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_jumlah_karyawan" int2,
  "peng_prof_tahun_mulai" int2,
  "peng_prof_jenis_usaha" int4,
  "peng_prof_komoditi_produk" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_omset_per_bulan" float8,
  "peng_prof_lokasi_pemasaran" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_pola_pemasaran" varchar(255) COLLATE "pg_catalog"."default",
  "peng_prof_pendapatan_penjualan" float8,
  "peng_prof_beban_penjualan" float8,
  "peng_prof_laba_per_bulan" float8,
  "peng_prof_modal_sendiri" float8,
  "peng_prof_modal_luar" float8,
  "peng_sk_kepala_kelurahan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_kecamatan" int4,
  "peng_sk_kota" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_luas" int4,
  "peng_sk_tanah_desa" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_kecamatan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_no_shm" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_tanggal_shm" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_atas_nama" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_harga_ru" float8,
  "peng_sk_tanah_harga_meter" float8,
  "peng_sk_tanah_luas_bangunan" int4,
  "peng_sk_tanah_harga_bangunan" float8,
  "peng_sk_tanah_letak_utara" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_letak_selatan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_letak_timur" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_letak_barat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sk_tanah_penggunaan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_pemegang_ktp_no" varchar COLLATE "pg_catalog"."default",
  "peng_jam_pekerjaan" varchar COLLATE "pg_catalog"."default",
  "peng_jam_tahun_pembuatan" int4,
  "peng_jam_nopol" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_mesin" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_rangka" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_atas_nama" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_alamat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_no_akta" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_tempat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_atas_nama_tanah" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_alamat_tanah" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_jenis_bpkb" int2,
  "peng_jam_jenis_tanah" int2,
  "peng_lokasi_lat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_lokasi_lon" varchar(255) COLLATE "pg_catalog"."default",
  "peng_lokasi_keterangan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_no_hp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_no_telp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_no_ktp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_srt_nama" varchar(255) COLLATE "pg_catalog"."default",
  "peng_srt_pekerjaan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_srt_nama_usaha" varchar(255) COLLATE "pg_catalog"."default",
  "peng_srt_jenis_usaha" int4,
  "peng_srt_alamat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_srt_jumlah_pinjaman" float8,
  "peng_srt_modal_kerja" float8,
  "peng_srt_investasi" float8,
  "peng_srt_pengambilan_waktu" int2,
  "peng_srt_bunga" float8,
  "peng_srt_omset_penjualan_pokok" float8,
  "peng_srt_pendapatan_lain" float8,
  "peng_srt_harga_pokok_penjualan" float8,
  "peng_srt_beban_bunga" float8,
  "peng_srt_beban_usaha" float8,
  "peng_srt_beban_non_usaha" float8,
  "peng_srt_laba" float8,
  "peng_lock_is" bool,
  "peng_lock_at" timestamp(6),
  "peng_lock_by" int4,
  "peng_tempat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_susunan_pengurus" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_akta_pendirian" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_buku_laporan_rapat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_jaminan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_ktp_pengurus" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_ktp_pengawas" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_siup" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_tdp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_npwp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_fc_sertifikat_penilaian" varchar(255) COLLATE "pg_catalog"."default",
  "peng_foto_pengawas" varchar(255) COLLATE "pg_catalog"."default",
  "peng_foto_pengurus" varchar(255) COLLATE "pg_catalog"."default",
  "peng_badan_hukum_no" varchar(255) COLLATE "pg_catalog"."default",
  "peng_badan_hukum_tanggal" date,
  "peng_kesehatan_usp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jumlah_anggota" int4,
  "peng_pelaksanaan_rat" varchar(255) COLLATE "pg_catalog"."default",
  "peng_ketua" varchar(255) COLLATE "pg_catalog"."default",
  "peng_sekretaris" varchar(255) COLLATE "pg_catalog"."default",
  "peng_bendahara" varchar(255) COLLATE "pg_catalog"."default",
  "peng_pengawas_koor" varchar(255) COLLATE "pg_catalog"."default",
  "peng_pengawas_anggota1" varchar(255) COLLATE "pg_catalog"."default",
  "peng_pengawas_anggota2" varchar(255) COLLATE "pg_catalog"."default",
  "peng_usaha_dikelola_1" varchar(255) COLLATE "pg_catalog"."default",
  "peng_usaha_dikelola_2" varchar(255) COLLATE "pg_catalog"."default",
  "peng_jam_jenis" int4,
  "peng_usaha_shu" float8,
  "peng_permodalan_kewajiban" float8,
  "peng_permodalan_modal_kerja" float8,
  "peng_permodalan_pinjaman_bank" float8,
  "peng_manf_meningkatkan_penjualan" float8,
  "peng_manf_menambah_modal" float8,
  "peng_manf_peningkatan_omset" float8,
  "peng_manf_peningkatan_shu" float8,
  "peng_manf_peningkatan_asset" float8,
  "peng_verif_is" bool,
  "peng_verif_by" int4,
  "peng_verif_at" timestamp(6),
  "peng_verif_reject_is" bool,
  "peng_verif_reject_by" int4,
  "peng_verif_reject_at" timestamp(6),
  "peng_verif_reject_note" text COLLATE "pg_catalog"."default",
  "peng_surv_is" bool,
  "peng_surv_id" int4,
  "peng_disetujui_nominal" float8,
  "peng_disetujui_tanggal_jatuh_tempo" date,
  "peng_disetujui_tanggal_penetapan" date,
  "peng_disetujui_jangka_waktu_bln" int4,
  "peng_disetujui_jangka_waktu_text" text COLLATE "pg_catalog"."default",
  "peng_disetujui_cicilan" float8,
  "peng_disetujui_created_at" timestamp(0),
  "peng_disetujui_created_by" int4,
  "peng_uji_kel_no_ktp" varchar(255) COLLATE "pg_catalog"."default",
  "peng_uji_kel_pekerjaan" varchar(255) COLLATE "pg_catalog"."default",
  "peng_disetujui_no_penetapan" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of pengajuan
-- ----------------------------
INSERT INTO "public"."pengajuan" VALUES (20, '2020-12-08', 1, 2, 'Modal usaha', NULL, NULL, NULL, NULL, NULL, NULL, 34, 100000000, 'Usaha Pecel Lele', 'Kediri', 'ALmi', 'ada', 10, 2010, 1, 'makanan', 10000000, 'kediri', 'online', 10000000, 10000000, 100000000, 1000000, 1000000, NULL, NULL, 'KEDIRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3506091223121231231', 'karyawan', 2019, 'Ag 2020 ie', '57657868779897', '172397899', 'almi', 'kediri', NULL, NULL, NULL, NULL, 1, NULL, '-7.812725', '112.014705', 'depan pom', NULL, NULL, NULL, 'Ari', 'Swasta', 'Pecel Lelel', 1, 'kediri', 1000000, 1000000, 1000000, 1, 100000, 10000000, 100000, 1000000, 10000000, 1000000, 10000000, 1000000, 't', '2020-12-08 20:31:05', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', 1, '2020-12-08 20:34:16', NULL, NULL, NULL, NULL, 't', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO "public"."pengajuan" VALUES (18, '2020-12-08', 1, 2, 'modal', NULL, NULL, NULL, NULL, NULL, NULL, 18, 100000000, 'Mie Ayam', 'kediri', 'almi kurniawan', 'nomor123', 10, 2020, 1, 'Mie', 1000000, 'Kediri', 'Online dan brosur', 10000000, 10000000, 10000000, 10000000, 10000000, 'Almi Kurniawan', 2, 'KEDIRI', 10, 'Jabon', 'Banyakan', 'nomor123', '2020-12-08', 'almi kurniawan', 10000000, 1500000, 10, 90000000, 'masjid', 'masjid', 'masjid', 'masjid', 'sebagai tempat tinggal', '261646853924398', 'Programmer', 2020, 'ag123', '123-234-2342', '95-23942-2342', 'almi kurniawan', 'kediri', NULL, NULL, NULL, NULL, 1, NULL, '-7.812725', '112.014705', 'Sebelahnya bakso makmur', NULL, NULL, NULL, 'almi Kurniawan', 'swasta', 'Mie Ayam Makmur', 1, 'Kediri', 1000000, 1000000, 100000000, 2, 2000000, 100000000, 1000000000000, 1000000000, 100000000, 100000000, 1000000000, 10000000, 't', '2020-12-08 02:58:23', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', 1, '2020-12-08 20:34:28', NULL, NULL, NULL, NULL, 't', 28, 100000000, '2020-12-10', '2020-12-09', 12, 'Bulan', 1000000, '2020-12-09 09:40:07', 1, NULL, NULL, 'no123123');
INSERT INTO "public"."pengajuan" VALUES (22, '2020-12-09', 1, 1, 'Mie', '1607563154_85e58df6643335f98274.jpg.jpg', '1607563154_b5834267362384b1e85e.jpg.jpg', NULL, NULL, NULL, NULL, 37, 5000000, 'Mie Ayam Makmur', 'Kediri', 'Anis Fahmi', 'nomor123', 10, 2020, 1, 'Mie', 10000000, 'Kediri', 'Online', 10000000, 3000000, 7000000, 10000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', '2020-12-09 19:20:21', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', 1, '2020-12-09 19:20:52', NULL, NULL, NULL, NULL, 't', 30, 5000000, '2020-12-10', '2020-12-10', 5, '5 Bulan', 1000000, '2020-12-10 08:23:05', 1, NULL, NULL, 'nomor123');
INSERT INTO "public"."pengajuan" VALUES (19, '2020-12-08', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 500000, 'Mie ayam makmur', 'kediri', 'almi kurniawan', 'nomor123', 10, 2020, 1, 'Mie', 10000000, 'Kediri', 'online', 10000000, NULL, NULL, NULL, NULL, 'Yusuf', 3, 'KEDIRI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', '2020-12-08 19:53:59', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', 23, '2020-12-08 20:01:46', NULL, NULL, NULL, NULL, 't', 27, 500000, '2020-12-10', '2020-12-10', 12, NULL, 12, '2020-12-09 09:17:45', 23, '35061368168136827', 'Swasta', 'tes123');
INSERT INTO "public"."pengajuan" VALUES (15, '2020-12-08', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, 500000, 'Mie Ayam', 'Kediri', 'Almi Kurniawan', 'nomor123', 10, 2020, 1, 'Mie', 10000, 'Kediri', 'offline dan online', 1000000, 1000000, 10000000, 10000000, 1000000000, 'Ari', 2, 'KEDIRI', 10, 'Jabon', 'Banyakan', 'nomor123', '2020-12-08', 'Almi Kurniawan', 20000000, 10000000, 10, 90000000, 'masjid', 'masjid', 'masjid', 'masjid', 'sebagai tempat tinggal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 500000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', '2020-12-08 02:08:03', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', 1, '2020-12-08 02:11:55', NULL, NULL, NULL, NULL, 't', 25, 1000000, '2020-12-08', '2020-12-08', 10, 'Tes', 100000, '2020-12-08 15:24:29', 1, '23642587168', 'programmer', '123/tes');
INSERT INTO "public"."pengajuan" VALUES (16, '2020-12-08', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, 10000000, 'KSP Cotra Abadi', 'kediri', NULL, NULL, 10, NULL, NULL, NULL, 1000000, NULL, NULL, 1000000, 100000, NULL, 1000000, 10000000, 'Nirwan', 2, 'Kediri', 1000000, 'ngasinan', 'plosoklaten', '123123214', '2020-12-31', 'fdsad', 1000000, 100000, 100000, 100000, 'toko', 'sungai', 'sungai', 'sungai', 'toko banguanan', '123123123123123', 'Swasta', NULL, NULL, NULL, NULL, NULL, NULL, '1312312312312', 'kediri', 'almi', 'kediri', NULL, 1, '-7.812725', '112.014705', 'tanah sengketa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000000, 10000000, 10000000, 1, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 10000, 't', '2020-12-08 02:09:06', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123123', '2020-11-30', 'sehat', 10, 'rat', 'Yusuf', 'Almi', 'Bendo', 'Edi', 'Sanco', 'Coko', 'Karaoke', 'Tukang Cukur', 2, 1000000, 100000, 1000000, 10000000, 10000, 10000, 10000, 1000, 10000, 't', 6, '2020-12-08 02:34:39', NULL, NULL, NULL, NULL, 't', 26, 10000000, '2020-12-08', '2020-12-08', 12, 'Bulan', 1000000, '2020-12-08 15:54:39', 1, NULL, NULL, '123');
INSERT INTO "public"."pengajuan" VALUES (21, '2020-12-08', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34, 10000000, 'KSP Abadi', 'kediri', NULL, NULL, 1000, NULL, NULL, NULL, 1000000, NULL, NULL, 100000, 1000000, NULL, 1000000, 10000010, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35090909111009111', 'karyawan', NULL, NULL, NULL, NULL, NULL, NULL, '12372631726', 'kediri', 'Pribadi', 'kediri', NULL, 1, '-7.812725', '112.014705', 'tes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000000, 1000000, 1000000, 1, 100000, 100000, 1000000, 100000, 1000000, 10000000, 1000000, 1000000, 't', '2020-12-08 20:56:51', 1, 'kediri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9128398', '2020-12-09', 'sehat', 100, 'rat', 'Ketua', 'Sekretaris', 'BEndahara', 'Koor 1', 'Anggo', 'anggo 2', 'Usaha 1', 'Usaha 2', 2, 1000000, 1000000, 1000000, 100000, 10000000, 1000000, 1000000, 1000000, 100000, 't', 1, '2020-12-08 20:56:58', NULL, NULL, NULL, NULL, 't', 29, 10000000, '2020-12-08', '2020-12-09', 12, 'Bulan', 100000, '2020-12-09 10:00:25', 1, NULL, NULL, '1231123');

-- ----------------------------
-- Table structure for pengajuan_foto
-- ----------------------------
DROP TABLE IF EXISTS "public"."pengajuan_foto";
CREATE TABLE "public"."pengajuan_foto" (
  "peng_foto_id" int4 NOT NULL DEFAULT nextval('pengajuan_foto_peng_foto_id_seq'::regclass),
  "peng_foto_peng_id" int4,
  "peng_foto_file" varchar COLLATE "pg_catalog"."default",
  "peng_foto_created_at" timestamp(6),
  "peng_foto_created_by" int4,
  "peng_foto_jenis" int2 DEFAULT 1
)
;

-- ----------------------------
-- Records of pengajuan_foto
-- ----------------------------
INSERT INTO "public"."pengajuan_foto" VALUES (12, 16, '1607414880_79c2906ccb38ea3c50fa.png', '2020-12-08 02:08:00', 6, 2);
INSERT INTO "public"."pengajuan_foto" VALUES (13, 18, '1607417655_24ab6d65d9acd5e8c7a3.jpg', '2020-12-08 02:54:15', 1, 1);
INSERT INTO "public"."pengajuan_foto" VALUES (14, 20, '1607480954_314c6d90f6777c9ea02b.jpg', '2020-12-08 20:29:14', 1, 1);
INSERT INTO "public"."pengajuan_foto" VALUES (15, 20, '1607480963_1533cbd2beb341cb53b7.jpg', '2020-12-08 20:29:23', 1, 2);
INSERT INTO "public"."pengajuan_foto" VALUES (16, 21, '1607482502_a8293944135c7e13fc6a.jpg', '2020-12-08 20:55:02', 1, 2);

-- ----------------------------
-- Table structure for ref_approval
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_approval";
CREATE TABLE "public"."ref_approval" (
  "ref_approval_id" int2 NOT NULL DEFAULT nextval('ref_approval_ref_approval_id_seq'::regclass),
  "ref_approval_label" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_approval
-- ----------------------------

-- ----------------------------
-- Table structure for ref_bidang_usaha
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_bidang_usaha";
CREATE TABLE "public"."ref_bidang_usaha" (
  "ref_bidang_id" int4 NOT NULL DEFAULT nextval('ref_bidang_usaha_ref_bidang_id_seq'::regclass),
  "ref_bidang_label" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_bidang_usaha
-- ----------------------------
INSERT INTO "public"."ref_bidang_usaha" VALUES (1, 'Kuliner');
INSERT INTO "public"."ref_bidang_usaha" VALUES (2, 'Peternakan');
INSERT INTO "public"."ref_bidang_usaha" VALUES (3, 'Pertanian');
INSERT INTO "public"."ref_bidang_usaha" VALUES (4, 'Jasa');

-- ----------------------------
-- Table structure for ref_group_akses
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_group_akses";
CREATE TABLE "public"."ref_group_akses" (
  "ref_group_akses_id" int4 NOT NULL DEFAULT nextval('ref_group_akses_ref_group_akses_id_seq'::regclass),
  "ref_group_akses_label" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_group_akses
-- ----------------------------

-- ----------------------------
-- Table structure for ref_jaminan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_jaminan";
CREATE TABLE "public"."ref_jaminan" (
  "ref_jaminan_id" int4 NOT NULL DEFAULT nextval('ref_jaminan_ref_jaminan_id_seq'::regclass),
  "ref_jaminan_label" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_jaminan
-- ----------------------------

-- ----------------------------
-- Table structure for ref_jenis_jaminan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_jenis_jaminan";
CREATE TABLE "public"."ref_jenis_jaminan" (
  "jns_jam_id" int4 NOT NULL DEFAULT nextval('jenis_jaminan_jns_jam_id_seq'::regclass),
  "jns_jam_label" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_jenis_jaminan
-- ----------------------------
INSERT INTO "public"."ref_jenis_jaminan" VALUES (1, 'Pribadi');
INSERT INTO "public"."ref_jenis_jaminan" VALUES (2, 'Orang Lain');

-- ----------------------------
-- Table structure for ref_jenis_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_jenis_pengajuan";
CREATE TABLE "public"."ref_jenis_pengajuan" (
  "jns_pengajuan_id" int4 NOT NULL DEFAULT nextval('ref_jenis_pengajuan_jns_pengajuan_id_seq'::regclass),
  "jns_pengajuan_label" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_jenis_pengajuan
-- ----------------------------
INSERT INTO "public"."ref_jenis_pengajuan" VALUES (1, 'Dibawah 10jt');
INSERT INTO "public"."ref_jenis_pengajuan" VALUES (2, 'Diatas 10jt');
INSERT INTO "public"."ref_jenis_pengajuan" VALUES (3, 'Dana Bergulir');

-- ----------------------------
-- Table structure for ref_kecamatan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_kecamatan";
CREATE TABLE "public"."ref_kecamatan" (
  "ref_kec_id" int4 NOT NULL DEFAULT nextval('ref_kecamatan_ref_kec_id_seq'::regclass),
  "ref_kec_label" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of ref_kecamatan
-- ----------------------------
INSERT INTO "public"."ref_kecamatan" VALUES (3, 'PESANTREN');
INSERT INTO "public"."ref_kecamatan" VALUES (2, 'MOJOROTO');
INSERT INTO "public"."ref_kecamatan" VALUES (1, 'KOTA');

-- ----------------------------
-- Table structure for ref_kelurahan
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_kelurahan";
CREATE TABLE "public"."ref_kelurahan" (
  "ref_kel_id" int4 NOT NULL DEFAULT nextval('ref_kelurahan_ref_kel_id_seq'::regclass),
  "ref_kel_label" varchar COLLATE "pg_catalog"."default",
  "ref_kel_kec_id" int4
)
;

-- ----------------------------
-- Records of ref_kelurahan
-- ----------------------------
INSERT INTO "public"."ref_kelurahan" VALUES (2, ' Semampir', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (3, ' Dandangan', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (4, ' Ngadirejo', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (5, ' Pakelan', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (6, ' Pocanan', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (7, ' Banjaran', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (8, ' Jagalan', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (9, ' Kemasan', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (10, ' Kaliombo', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (11, ' Kampung Dalem', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (12, ' Ngronggo', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (13, ' Manisrenggo', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (14, ' Balowerti', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (15, ' Rejomulyo', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (16, ' Ringin Anom', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (17, ' Setono Gedong', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (18, ' Setono Pande', 1);
INSERT INTO "public"."ref_kelurahan" VALUES (19, 'Lirboyo', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (20, ' Campurejo', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (21, ' Bandar Lor', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (22, ' Dermo', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (23, ' Mrican', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (24, ' Mojoroto', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (25, ' Ngampel', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (26, ' Gayam', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (27, ' Sukorame', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (28, ' Pojok', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (29, ' Tamanan', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (30, ' Bandar Kidul', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (31, ' Banjarmelati', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (32, ' Bujel', 2);
INSERT INTO "public"."ref_kelurahan" VALUES (33, 'Jamsaren', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (34, ' Bangsal', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (35, ' Burengan', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (36, ' Pesantren', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (37, ' Pakunden', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (38, ' Singonegaran', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (39, ' Tinalan', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (40, ' Banaran', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (41, ' Tosaren', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (42, ' Betet', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (43, ' Blabak', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (44, ' Bawang', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (45, ' Ngletih', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (46, ' Tempurejo', 3);
INSERT INTO "public"."ref_kelurahan" VALUES (47, ' Ketami', 3);

-- ----------------------------
-- Table structure for ref_modul_akses
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_modul_akses";
CREATE TABLE "public"."ref_modul_akses" (
  "ref_modul_akses_id" int4 NOT NULL DEFAULT nextval('ref_modul_akses_ref_modul_akses_id_seq'::regclass),
  "ref_modul_akses_label" varchar(255) COLLATE "pg_catalog"."default",
  "ref_modul_akses_group_id" int4
)
;

-- ----------------------------
-- Records of ref_modul_akses
-- ----------------------------

-- ----------------------------
-- Table structure for ref_user_akses
-- ----------------------------
DROP TABLE IF EXISTS "public"."ref_user_akses";
CREATE TABLE "public"."ref_user_akses" (
  "ref_user_akses_id" int4 NOT NULL DEFAULT nextval('ref_user_akses_ref_user_akses_id_seq'::regclass),
  "ref_user_akses_user_id" int4,
  "ref_user_akses_group_id" int4
)
;

-- ----------------------------
-- Records of ref_user_akses
-- ----------------------------

-- ----------------------------
-- Table structure for survey
-- ----------------------------
DROP TABLE IF EXISTS "public"."survey";
CREATE TABLE "public"."survey" (
  "survey_id" int4 NOT NULL DEFAULT nextval('survey_survey_id_seq'::regclass),
  "survey_nomor" int4,
  "survey_nomor_lengkap" varchar(255) COLLATE "pg_catalog"."default",
  "survey_dasar" varchar(255) COLLATE "pg_catalog"."default",
  "survey_untuk" varchar(255) COLLATE "pg_catalog"."default",
  "survey_keterangan" text COLLATE "pg_catalog"."default",
  "survey_tanggal" date,
  "survey_ttd_kar_id" int4,
  "survey_created_by" int4,
  "survey_created_at" timestamp(6)
)
;

-- ----------------------------
-- Records of survey
-- ----------------------------
INSERT INTO "public"."survey" VALUES (25, NULL, '1/sruv/2020/12', 'ujicoba', 'ujicoba', 'ujicoba', '2020-12-08', NULL, 1, '2020-12-08 02:13:59');
INSERT INTO "public"."survey" VALUES (26, NULL, '123', 'negara', 'usaha', 'oke', '2020-12-23', NULL, 6, '2020-12-08 02:34:54');
INSERT INTO "public"."survey" VALUES (27, NULL, 'no123', 'tes', 'tes', 'tes', '2020-12-12', NULL, 23, '2020-12-08 20:04:20');
INSERT INTO "public"."survey" VALUES (28, NULL, '123123', 'negara', 'ujicoba', 'ujicoba1', '2020-12-09', NULL, 1, '2020-12-08 20:34:39');
INSERT INTO "public"."survey" VALUES (29, NULL, '11233', 'ujicoba', 'ujicoba', 'ujicoba', '2020-12-09', NULL, 1, '2020-12-08 20:57:30');
INSERT INTO "public"."survey" VALUES (30, NULL, 'nomor123', 'Ujicoba', 'Ujicoba', 'Ujicoba', '2020-12-10', NULL, 1, '2020-12-09 19:20:59');

-- ----------------------------
-- Table structure for survey_detail
-- ----------------------------
DROP TABLE IF EXISTS "public"."survey_detail";
CREATE TABLE "public"."survey_detail" (
  "survey_det_id" int4 NOT NULL DEFAULT nextval('survey_detail_survey_det_id_seq'::regclass),
  "survey_det_kar_id" int4,
  "survey_det_created_at" timestamp(6),
  "survey_det_created_by" int4,
  "survey_det_head_id" int4
)
;

-- ----------------------------
-- Records of survey_detail
-- ----------------------------
INSERT INTO "public"."survey_detail" VALUES (7, 2, NULL, NULL, 25);
INSERT INTO "public"."survey_detail" VALUES (8, 1, NULL, NULL, 25);
INSERT INTO "public"."survey_detail" VALUES (9, 2, NULL, NULL, 26);
INSERT INTO "public"."survey_detail" VALUES (10, 2, NULL, NULL, 27);
INSERT INTO "public"."survey_detail" VALUES (11, 1, NULL, NULL, 27);
INSERT INTO "public"."survey_detail" VALUES (12, 2, NULL, NULL, 28);
INSERT INTO "public"."survey_detail" VALUES (13, 1, NULL, NULL, 28);
INSERT INTO "public"."survey_detail" VALUES (14, 2, NULL, NULL, 29);
INSERT INTO "public"."survey_detail" VALUES (15, 1, NULL, NULL, 29);
INSERT INTO "public"."survey_detail" VALUES (16, 2, NULL, NULL, 30);
INSERT INTO "public"."survey_detail" VALUES (17, 1, NULL, NULL, 30);

-- ----------------------------
-- Table structure for survey_hasil
-- ----------------------------
DROP TABLE IF EXISTS "public"."survey_hasil";
CREATE TABLE "public"."survey_hasil" (
  "survey_hasil_id" int4 NOT NULL DEFAULT nextval('survey_hasil_survey_hasil_id_seq'::regclass),
  "survey_hasil_survey_id" int4,
  "survey_hasil_peng_id" int4,
  "survey_hasil_1_perijinan" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_1_nilai_kes_usp" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_1_rat" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_1_jml_angg_produktif" int4,
  "survey_hasil_1_jml_angg" int4,
  "survey_hasil_2_modal_sendiri" int8,
  "survey_hasil_2_modal_luar" int8,
  "survey_hasil_3_usaha" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_3_omset_per_tahun" int8,
  "survey_hasil_3_pendptn_per_tahun" int8,
  "survey_hasil_3_beban_operasional" int8,
  "survey_hasil_3_shu" int8,
  "survey_hasil_4_kas_per_bulan" int8,
  "survey_hasil_4_pengeluaran" int8,
  "survey_hasil_4_saldo" int8,
  "survey_hasil_5_jaminan" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_5_taksiran_harga" int8,
  "survey_hasil_5_status_jaminan" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_6_kelangsungan_hidup" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_permasalahan" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_created_at" timestamp(6),
  "survey_hasil_created_by" int4,
  "survey_hasil_1_status" varchar(255) COLLATE "pg_catalog"."default",
  "survey_hasil_lock_is" bool DEFAULT false,
  "survey_hasil_lock_at" timestamp(6),
  "survey_hasil_lock_by" int4,
  "survey_hasil_approve_is" bool,
  "survey_hasil_approve_at" timestamp(6),
  "survey_hasil_approve_by" int4,
  "survey_hasil_reject_is" bool,
  "survey_hasil_reject_at" timestamp(6),
  "survey_hasil_reject_by" int4
)
;

-- ----------------------------
-- Records of survey_hasil
-- ----------------------------
INSERT INTO "public"."survey_hasil" VALUES (5, 26, 16, 'adfa', 'afssf', 'asdf', 10000, 1000, 1000, 100, 'jop', 1000, 1000, 1000, NULL, 100, 100, NULL, 'uhikgui', 1000, 'gjj', 'dfghdfg', 'sfgg', '2020-12-08 15:39:40.998846', NULL, '1000', 't', '2020-12-08 15:36:45.104531', 6, 't', '2020-12-08 15:36:54.971246', 6, 'f', NULL, NULL);
INSERT INTO "public"."survey_hasil" VALUES (4, 25, 15, 'ujicoba', 'ujicoba', 'ujicoba', 10, 20, 100000, 100000, 'ujicoba', 10000000, 100000000, 10000000, NULL, 100000000, 10000000, NULL, 'valid', 10000000, 'diterima', 'ujicoba', 'ujicoba', '2020-12-08 15:22:40.409904', NULL, 'legal', 't', '2020-12-08 15:22:45.973726', 1, 't', '2020-12-08 15:43:15.086473', 6, 'f', NULL, NULL);
INSERT INTO "public"."survey_hasil" VALUES (6, 27, 19, 'Legal', 'es', 'es', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 09:08:28.274661', NULL, NULL, 't', '2020-12-09 09:08:17.933509', 23, 't', '2020-12-09 09:09:27.644886', 23, 'f', NULL, NULL);
INSERT INTO "public"."survey_hasil" VALUES (7, 28, 18, '123123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 09:57:09.345391', NULL, NULL, 't', '2020-12-09 09:36:47.540486', 1, 't', '2020-12-09 09:37:03.07969', 1, 'f', NULL, NULL);
INSERT INTO "public"."survey_hasil" VALUES (8, 28, 20, '123', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 09:57:14.865457', NULL, NULL, 't', '2020-12-09 09:36:50.250997', 1, 'f', NULL, NULL, 't', '2020-12-09 09:39:19.293252', 1);
INSERT INTO "public"."survey_hasil" VALUES (9, 29, 21, 'ujicoba', 'ujicoba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 09:59:17.867407', NULL, NULL, 't', '2020-12-09 09:59:04.170638', 1, 't', '2020-12-09 09:59:44.363989', 1, 'f', '2020-12-09 09:59:33.157449', 1);
INSERT INTO "public"."survey_hasil" VALUES (10, 30, 22, 'legal', 'ujicoba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-10 08:22:15.847751', NULL, NULL, 't', '2020-12-10 08:22:21.136382', 1, 't', '2020-12-10 08:22:32.251135', 1, 'f', NULL, NULL);

-- ----------------------------
-- Table structure for survey_tempat
-- ----------------------------
DROP TABLE IF EXISTS "public"."survey_tempat";
CREATE TABLE "public"."survey_tempat" (
  "survey_tem_id" int4 NOT NULL DEFAULT nextval('survey_tempat_survey_tem_id_seq'::regclass),
  "survey_tem_head_id" int4,
  "survey_tem_peng_id" int4
)
;

-- ----------------------------
-- Records of survey_tempat
-- ----------------------------
INSERT INTO "public"."survey_tempat" VALUES (12, 25, 15);
INSERT INTO "public"."survey_tempat" VALUES (13, 26, 16);
INSERT INTO "public"."survey_tempat" VALUES (14, 27, 19);
INSERT INTO "public"."survey_tempat" VALUES (15, 28, 20);
INSERT INTO "public"."survey_tempat" VALUES (16, 28, 18);
INSERT INTO "public"."survey_tempat" VALUES (17, 29, 21);
INSERT INTO "public"."survey_tempat" VALUES (18, 30, 22);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS "public"."user";
CREATE TABLE "public"."user" (
  "user_id" int4 NOT NULL DEFAULT nextval('user_user_id_seq'::regclass),
  "user_name" varchar COLLATE "pg_catalog"."default",
  "user_password" varchar(255) COLLATE "pg_catalog"."default",
  "user_kar_id" int4,
  "user_disable" bool,
  "user_created_at" timestamp(6),
  "user_namalengkap" varchar(255) COLLATE "pg_catalog"."default",
  "user_member_id" int4
)
;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO "public"."user" VALUES (15, 'yus', '36c3eaa0e1e290f41e2810bae8d9502c785e92d9', 0, NULL, '2020-10-23 15:39:55.106223', 'yusuf', 18);
INSERT INTO "public"."user" VALUES (19, 'almikurniawan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, NULL, '2020-11-06 15:08:25.874301', 'mohammad almi kurniawan', 32);
INSERT INTO "public"."user" VALUES (20, 'patria', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, NULL, '2020-11-20 09:45:15.074359', 'PATRIA HADI WIJAYA,SH', NULL);
INSERT INTO "public"."user" VALUES (21, 'husna', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, NULL, '2020-11-20 09:47:41.181877', 'HUSNAWATI,S.Sos', NULL);
INSERT INTO "public"."user" VALUES (6, 'yus', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, NULL, NULL, 'yusuf', 17);
INSERT INTO "public"."user" VALUES (3, 'wina', '2fee5e53252cce3b7146551b6459fc99c3e28041', 0, NULL, NULL, 'wina', NULL);
INSERT INTO "public"."user" VALUES (2, 'surveyor', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 'f', '2020-09-16 10:34:30.089515', 'Almi', NULL);
INSERT INTO "public"."user" VALUES (1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 0, 'f', '2020-09-16 10:34:30.089515', 'Yusuf', NULL);
INSERT INTO "public"."user" VALUES (22, 'ari', '7158a9e0f8e84a0a74ed148e0f652dfbd4913a18', NULL, NULL, '2020-12-08 14:32:26.902357', 'ari', 34);
INSERT INTO "public"."user" VALUES (23, 'almikur', 'a9e0378601ec4a08f949292d349f0c9abe8f82e8', NULL, NULL, '2020-12-09 08:27:34.243121', 'almi kurniawan', 35);
INSERT INTO "public"."user" VALUES (24, 'ucup', '36c3eaa0e1e290f41e2810bae8d9502c785e92d9', NULL, NULL, '2020-12-09 09:00:04.940915', 'almi kurniawan', 36);
INSERT INTO "public"."user" VALUES (25, 'anis', '36c3eaa0e1e290f41e2810bae8d9502c785e92d9', NULL, NULL, '2020-12-10 08:18:38.105918', 'Anis Fahmi', 37);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."jenis_jaminan_jns_jam_id_seq"
OWNED BY "public"."ref_jenis_jaminan"."jns_jam_id";
SELECT setval('"public"."jenis_jaminan_jns_jam_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."karyawan_kar_id_seq"
OWNED BY "public"."karyawan"."kar_id";
SELECT setval('"public"."karyawan_kar_id_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."member_member_id_seq"
OWNED BY "public"."member"."member_id";
SELECT setval('"public"."member_member_id_seq"', 38, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."pembayaran_pembayaran_id_seq"
OWNED BY "public"."pembayaran"."pembayaran_id";
SELECT setval('"public"."pembayaran_pembayaran_id_seq"', 278, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."pengajuan_foto_peng_foto_id_seq"
OWNED BY "public"."pengajuan_foto"."peng_foto_id";
SELECT setval('"public"."pengajuan_foto_peng_foto_id_seq"', 17, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."pengajuan_peng_id_seq"
OWNED BY "public"."pengajuan"."peng_id";
SELECT setval('"public"."pengajuan_peng_id_seq"', 23, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_approval_ref_approval_id_seq"
OWNED BY "public"."ref_approval"."ref_approval_id";
SELECT setval('"public"."ref_approval_ref_approval_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_bidang_usaha_ref_bidang_id_seq"
OWNED BY "public"."ref_bidang_usaha"."ref_bidang_id";
SELECT setval('"public"."ref_bidang_usaha_ref_bidang_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_group_akses_ref_group_akses_id_seq"
OWNED BY "public"."ref_group_akses"."ref_group_akses_id";
SELECT setval('"public"."ref_group_akses_ref_group_akses_id_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_jaminan_ref_jaminan_id_seq"
OWNED BY "public"."ref_jaminan"."ref_jaminan_id";
SELECT setval('"public"."ref_jaminan_ref_jaminan_id_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_jenis_pengajuan_jns_pengajuan_id_seq"
OWNED BY "public"."ref_jenis_pengajuan"."jns_pengajuan_id";
SELECT setval('"public"."ref_jenis_pengajuan_jns_pengajuan_id_seq"', 4, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_kecamatan_ref_kec_id_seq"
OWNED BY "public"."ref_kecamatan"."ref_kec_id";
SELECT setval('"public"."ref_kecamatan_ref_kec_id_seq"', 4, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_kelurahan_ref_kel_id_seq"
OWNED BY "public"."ref_kelurahan"."ref_kel_id";
SELECT setval('"public"."ref_kelurahan_ref_kel_id_seq"', 48, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_modul_akses_ref_modul_akses_id_seq"
OWNED BY "public"."ref_modul_akses"."ref_modul_akses_id";
SELECT setval('"public"."ref_modul_akses_ref_modul_akses_id_seq"', 19, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ref_user_akses_ref_user_akses_id_seq"
OWNED BY "public"."ref_user_akses"."ref_user_akses_id";
SELECT setval('"public"."ref_user_akses_ref_user_akses_id_seq"', 31, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."survey_detail_survey_det_id_seq"
OWNED BY "public"."survey_detail"."survey_det_id";
SELECT setval('"public"."survey_detail_survey_det_id_seq"', 18, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."survey_hasil_survey_hasil_id_seq"
OWNED BY "public"."survey_hasil"."survey_hasil_id";
SELECT setval('"public"."survey_hasil_survey_hasil_id_seq"', 11, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."survey_survey_id_seq"
OWNED BY "public"."survey"."survey_id";
SELECT setval('"public"."survey_survey_id_seq"', 31, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."survey_tempat_survey_tem_id_seq"
OWNED BY "public"."survey_tempat"."survey_tem_id";
SELECT setval('"public"."survey_tempat_survey_tem_id_seq"', 19, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."user_user_id_seq"
OWNED BY "public"."user"."user_id";
SELECT setval('"public"."user_user_id_seq"', 26, true);

-- ----------------------------
-- Primary Key structure for table karyawan
-- ----------------------------
ALTER TABLE "public"."karyawan" ADD CONSTRAINT "karyawan_pkey" PRIMARY KEY ("kar_id");

-- ----------------------------
-- Primary Key structure for table member
-- ----------------------------
ALTER TABLE "public"."member" ADD CONSTRAINT "member_pkey" PRIMARY KEY ("member_id");

-- ----------------------------
-- Primary Key structure for table pembayaran
-- ----------------------------
ALTER TABLE "public"."pembayaran" ADD CONSTRAINT "pembayaran_pkey" PRIMARY KEY ("pembayaran_id");

-- ----------------------------
-- Primary Key structure for table pengajuan
-- ----------------------------
ALTER TABLE "public"."pengajuan" ADD CONSTRAINT "pengajuan_pkey" PRIMARY KEY ("peng_id");

-- ----------------------------
-- Primary Key structure for table pengajuan_foto
-- ----------------------------
ALTER TABLE "public"."pengajuan_foto" ADD CONSTRAINT "pengajuan_foto_pkey" PRIMARY KEY ("peng_foto_id");

-- ----------------------------
-- Primary Key structure for table ref_bidang_usaha
-- ----------------------------
ALTER TABLE "public"."ref_bidang_usaha" ADD CONSTRAINT "ref_bidang_usaha_pkey" PRIMARY KEY ("ref_bidang_id");

-- ----------------------------
-- Primary Key structure for table ref_group_akses
-- ----------------------------
ALTER TABLE "public"."ref_group_akses" ADD CONSTRAINT "ref_group_akses_pkey" PRIMARY KEY ("ref_group_akses_id");

-- ----------------------------
-- Primary Key structure for table ref_jenis_jaminan
-- ----------------------------
ALTER TABLE "public"."ref_jenis_jaminan" ADD CONSTRAINT "jenis_jaminan_pkey" PRIMARY KEY ("jns_jam_id");

-- ----------------------------
-- Primary Key structure for table ref_jenis_pengajuan
-- ----------------------------
ALTER TABLE "public"."ref_jenis_pengajuan" ADD CONSTRAINT "ref_jenis_pengajuan_pkey" PRIMARY KEY ("jns_pengajuan_id");

-- ----------------------------
-- Primary Key structure for table ref_kecamatan
-- ----------------------------
ALTER TABLE "public"."ref_kecamatan" ADD CONSTRAINT "ref_kecamatan_pkey" PRIMARY KEY ("ref_kec_id");

-- ----------------------------
-- Primary Key structure for table ref_kelurahan
-- ----------------------------
ALTER TABLE "public"."ref_kelurahan" ADD CONSTRAINT "ref_kelurahan_pkey" PRIMARY KEY ("ref_kel_id");

-- ----------------------------
-- Primary Key structure for table ref_modul_akses
-- ----------------------------
ALTER TABLE "public"."ref_modul_akses" ADD CONSTRAINT "ref_modul_akses_pkey" PRIMARY KEY ("ref_modul_akses_id");

-- ----------------------------
-- Primary Key structure for table ref_user_akses
-- ----------------------------
ALTER TABLE "public"."ref_user_akses" ADD CONSTRAINT "ref_user_akses_pkey" PRIMARY KEY ("ref_user_akses_id");

-- ----------------------------
-- Primary Key structure for table survey_detail
-- ----------------------------
ALTER TABLE "public"."survey_detail" ADD CONSTRAINT "survey_detail_pkey" PRIMARY KEY ("survey_det_id");

-- ----------------------------
-- Primary Key structure for table survey_hasil
-- ----------------------------
ALTER TABLE "public"."survey_hasil" ADD CONSTRAINT "survey_hasil_pkey" PRIMARY KEY ("survey_hasil_id");

-- ----------------------------
-- Primary Key structure for table user
-- ----------------------------
ALTER TABLE "public"."user" ADD CONSTRAINT "user_pkey" PRIMARY KEY ("user_id");
