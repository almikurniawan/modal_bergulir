--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5
-- Dumped by pg_dump version 10.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: ref_jenis_jaminan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_jenis_jaminan (
    jns_jam_id integer NOT NULL,
    jns_jam_label character varying
);


ALTER TABLE public.ref_jenis_jaminan OWNER TO postgres;

--
-- Name: jenis_jaminan_jns_jam_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jenis_jaminan_jns_jam_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jenis_jaminan_jns_jam_id_seq OWNER TO postgres;

--
-- Name: jenis_jaminan_jns_jam_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jenis_jaminan_jns_jam_id_seq OWNED BY public.ref_jenis_jaminan.jns_jam_id;


--
-- Name: karyawan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.karyawan (
    kar_id integer NOT NULL,
    kar_nama character varying,
    kar_nip character varying(255),
    kar_pangkat character varying(255),
    kar_jabatan character varying(255),
    kar_created_at timestamp(6) without time zone,
    kar_created_by integer,
    kar_visible boolean
);


ALTER TABLE public.karyawan OWNER TO postgres;

--
-- Name: karyawan_kar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.karyawan_kar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.karyawan_kar_id_seq OWNER TO postgres;

--
-- Name: karyawan_kar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.karyawan_kar_id_seq OWNED BY public.karyawan.kar_id;


--
-- Name: member; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.member (
    member_id integer NOT NULL,
    member_nama_lengkap character varying,
    member_alamat character varying(255),
    member_no_telp character varying(255),
    member_kelurahan character varying(255),
    member_created_at timestamp(6) without time zone,
    member_created_by integer,
    member_updated_by integer,
    member_updated_at timestamp without time zone,
    member_visible boolean DEFAULT true
);


ALTER TABLE public.member OWNER TO postgres;

--
-- Name: member_member_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.member_member_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.member_member_id_seq OWNER TO postgres;

--
-- Name: member_member_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.member_member_id_seq OWNED BY public.member.member_id;


--
-- Name: pembayaran; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pembayaran (
    pembayaran_id integer NOT NULL,
    pembayaran_peng_id integer,
    pembayaran_tanggal date,
    pembayaran_cicilan integer,
    pembayaran_ke integer,
    pembayaran_lunas_is boolean,
    pembayaran_lunas_tanggal date
);


ALTER TABLE public.pembayaran OWNER TO postgres;

--
-- Name: pembayaran_pembayaran_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pembayaran_pembayaran_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pembayaran_pembayaran_id_seq OWNER TO postgres;

--
-- Name: pembayaran_pembayaran_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pembayaran_pembayaran_id_seq OWNED BY public.pembayaran.pembayaran_id;


--
-- Name: pengajuan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengajuan (
    peng_id integer NOT NULL,
    peng_tanggal date,
    peng_bidang_usaha integer,
    peng_jenis_pengajuan smallint,
    peng_tujuan_penggunaan character varying(255),
    peng_foto_suami character varying(255),
    peng_foto_istri character varying(255),
    peng_fc_ktp character varying(255),
    peng_fc_kk character varying(255),
    peng_fc_surat_nikah character varying(255),
    peng_fc_legalitas_jaminan character varying(255),
    peng_member_id integer,
    peng_nominal double precision,
    peng_prof_nama_usaha character varying(255),
    peng_prof_alamat character varying(255),
    peng_prof_pimpinan character varying(255),
    peng_prof_perizinan character varying(255),
    peng_prof_jumlah_karyawan smallint,
    peng_prof_tahun_mulai smallint,
    peng_prof_jenis_usaha integer,
    peng_prof_komoditi_produk character varying(255),
    peng_prof_omset_per_bulan double precision,
    peng_prof_lokasi_pemasaran character varying(255),
    peng_prof_pola_pemasaran character varying(255),
    peng_prof_pendapatan_penjualan double precision,
    peng_prof_beban_penjualan double precision,
    peng_prof_laba_per_bulan double precision,
    peng_prof_modal_sendiri double precision,
    peng_prof_modal_luar double precision,
    peng_sk_kepala_kelurahan character varying(255),
    peng_sk_kecamatan integer,
    peng_sk_kota character varying(255),
    peng_sk_tanah_luas smallint,
    peng_sk_tanah_desa character varying(255),
    peng_sk_tanah_kecamatan character varying(255),
    peng_sk_tanah_no_shm character varying(255),
    peng_sk_tanah_tanggal_shm character varying(255),
    peng_sk_tanah_atas_nama character varying(255),
    peng_sk_tanah_harga_ru double precision,
    peng_sk_tanah_harga_meter double precision,
    peng_sk_tanah_luas_bangunan integer,
    peng_sk_tanah_harga_bangunan double precision,
    peng_sk_tanah_letak_utara character varying(255),
    peng_sk_tanah_letak_selatan character varying(255),
    peng_sk_tanah_letak_timur character varying(255),
    peng_sk_tanah_letak_barat character varying(255),
    peng_sk_tanah_penggunaan character varying(255),
    peng_jam_pemegang_ktp_no character varying,
    peng_jam_pekerjaan character varying,
    peng_jam_tahun_pembuatan integer,
    peng_jam_nopol character varying(255),
    peng_jam_mesin character varying(255),
    peng_jam_rangka character varying(255),
    peng_jam_atas_nama character varying(255),
    peng_jam_alamat character varying(255),
    peng_jam_no_akta character varying(255),
    peng_jam_tempat character varying(255),
    peng_jam_atas_nama_tanah character varying(255),
    peng_jam_alamat_tanah character varying(255),
    peng_jam_jenis_bpkb smallint,
    peng_jam_jenis_tanah smallint,
    peng_lokasi_lat character varying(255),
    peng_lokasi_lon character varying(255),
    peng_lokasi_keterangan character varying(255),
    peng_no_hp character varying(255),
    peng_no_telp character varying(255),
    peng_no_ktp character varying(255),
    peng_srt_nama character varying(255),
    peng_srt_pekerjaan character varying(255),
    peng_srt_nama_usaha character varying(255),
    peng_srt_jenis_usaha integer,
    peng_srt_alamat character varying(255),
    peng_srt_jumlah_pinjaman double precision,
    peng_srt_modal_kerja double precision,
    peng_srt_investasi double precision,
    peng_srt_pengambilan_waktu smallint,
    peng_srt_bunga double precision,
    peng_srt_omset_penjualan_pokok double precision,
    peng_srt_pendapatan_lain double precision,
    peng_srt_harga_pokok_penjualan double precision,
    peng_srt_beban_bunga double precision,
    peng_srt_beban_usaha double precision,
    peng_srt_beban_non_usaha double precision,
    peng_srt_laba double precision,
    peng_lock_is boolean,
    peng_lock_at timestamp(6) without time zone,
    peng_lock_by integer,
    peng_tempat character varying(255),
    peng_susunan_pengurus character varying(255),
    peng_fc_akta_pendirian character varying(255),
    peng_fc_buku_laporan_rapat character varying(255),
    peng_fc_jaminan character varying(255),
    peng_fc_ktp_pengurus character varying(255),
    peng_fc_ktp_pengawas character varying(255),
    peng_fc_siup character varying(255),
    peng_fc_tdp character varying(255),
    peng_fc_npwp character varying(255),
    peng_fc_sertifikat_penilaian character varying(255),
    peng_foto_pengawas character varying(255),
    peng_foto_pengurus character varying(255),
    peng_badan_hukum_no character varying(255),
    peng_badan_hukum_tanggal date,
    peng_kesehatan_usp character varying(255),
    peng_jumlah_anggota integer,
    peng_pelaksanaan_rat character varying(255),
    peng_ketua character varying(255),
    peng_sekretaris character varying(255),
    peng_bendahara character varying(255),
    peng_pengawas_koor character varying(255),
    peng_pengawas_anggota1 character varying(255),
    peng_pengawas_anggota2 character varying(255),
    peng_usaha_dikelola_1 character varying(255),
    peng_usaha_dikelola_2 character varying(255),
    peng_jam_jenis integer,
    peng_usaha_shu double precision,
    peng_permodalan_kewajiban double precision,
    peng_permodalan_modal_kerja double precision,
    peng_permodalan_pinjaman_bank double precision,
    peng_manf_meningkatkan_penjualan double precision,
    peng_manf_menambah_modal double precision,
    peng_manf_peningkatan_omset double precision,
    peng_manf_peningkatan_shu double precision,
    peng_manf_peningkatan_asset double precision,
    peng_verif_is boolean,
    peng_verif_by integer,
    peng_verif_at timestamp(6) without time zone,
    peng_verif_reject_is boolean,
    peng_verif_reject_by integer,
    peng_verif_reject_at timestamp(6) without time zone,
    peng_verif_reject_note text,
    peng_surv_is boolean,
    peng_surv_id integer,
    peng_disetujui_nominal double precision,
    peng_disetujui_tanggal_jatuh_tempo date,
    peng_disetujui_tanggal_penetapan date,
    peng_disetujui_jangka_waktu_bln integer,
    peng_disetujui_jangka_waktu_text text,
    peng_disetujui_cicilan double precision,
    peng_disetujui_created_at timestamp(0) without time zone,
    peng_disetujui_created_by integer
);


ALTER TABLE public.pengajuan OWNER TO postgres;

--
-- Name: pengajuan_foto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pengajuan_foto (
    peng_foto_id integer NOT NULL,
    peng_foto_peng_id integer,
    peng_foto_file character varying,
    peng_foto_created_at timestamp(6) without time zone,
    peng_foto_created_by integer,
    peng_foto_jenis smallint DEFAULT 1
);


ALTER TABLE public.pengajuan_foto OWNER TO postgres;

--
-- Name: pengajuan_foto_peng_foto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengajuan_foto_peng_foto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pengajuan_foto_peng_foto_id_seq OWNER TO postgres;

--
-- Name: pengajuan_foto_peng_foto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengajuan_foto_peng_foto_id_seq OWNED BY public.pengajuan_foto.peng_foto_id;


--
-- Name: pengajuan_peng_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pengajuan_peng_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pengajuan_peng_id_seq OWNER TO postgres;

--
-- Name: pengajuan_peng_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pengajuan_peng_id_seq OWNED BY public.pengajuan.peng_id;


--
-- Name: ref_approval; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_approval (
    ref_approval_id smallint NOT NULL,
    ref_approval_label character varying(255)
);


ALTER TABLE public.ref_approval OWNER TO postgres;

--
-- Name: ref_approval_ref_approval_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_approval_ref_approval_id_seq
    AS smallint
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_approval_ref_approval_id_seq OWNER TO postgres;

--
-- Name: ref_approval_ref_approval_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_approval_ref_approval_id_seq OWNED BY public.ref_approval.ref_approval_id;


--
-- Name: ref_bidang_usaha; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_bidang_usaha (
    ref_bidang_id integer NOT NULL,
    ref_bidang_label character varying
);


ALTER TABLE public.ref_bidang_usaha OWNER TO postgres;

--
-- Name: ref_bidang_usaha_ref_bidang_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_bidang_usaha_ref_bidang_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_bidang_usaha_ref_bidang_id_seq OWNER TO postgres;

--
-- Name: ref_bidang_usaha_ref_bidang_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_bidang_usaha_ref_bidang_id_seq OWNED BY public.ref_bidang_usaha.ref_bidang_id;


--
-- Name: ref_group_akses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_group_akses (
    ref_group_akses_id integer NOT NULL,
    ref_group_akses_label character varying(255)
);


ALTER TABLE public.ref_group_akses OWNER TO postgres;

--
-- Name: ref_group_akses_ref_group_akses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_group_akses_ref_group_akses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.ref_group_akses_ref_group_akses_id_seq OWNER TO postgres;

--
-- Name: ref_group_akses_ref_group_akses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_group_akses_ref_group_akses_id_seq OWNED BY public.ref_group_akses.ref_group_akses_id;


--
-- Name: ref_jaminan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_jaminan (
    ref_jaminan_id integer NOT NULL,
    ref_jaminan_label character varying(255)
);


ALTER TABLE public.ref_jaminan OWNER TO postgres;

--
-- Name: ref_jaminan_ref_jaminan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_jaminan_ref_jaminan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_jaminan_ref_jaminan_id_seq OWNER TO postgres;

--
-- Name: ref_jaminan_ref_jaminan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_jaminan_ref_jaminan_id_seq OWNED BY public.ref_jaminan.ref_jaminan_id;


--
-- Name: ref_jenis_pengajuan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_jenis_pengajuan (
    jns_pengajuan_id integer NOT NULL,
    jns_pengajuan_label character varying
);


ALTER TABLE public.ref_jenis_pengajuan OWNER TO postgres;

--
-- Name: ref_jenis_pengajuan_jns_pengajuan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_jenis_pengajuan_jns_pengajuan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_jenis_pengajuan_jns_pengajuan_id_seq OWNER TO postgres;

--
-- Name: ref_jenis_pengajuan_jns_pengajuan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_jenis_pengajuan_jns_pengajuan_id_seq OWNED BY public.ref_jenis_pengajuan.jns_pengajuan_id;


--
-- Name: ref_kecamatan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_kecamatan (
    ref_kec_id integer NOT NULL,
    ref_kec_label character varying
);


ALTER TABLE public.ref_kecamatan OWNER TO postgres;

--
-- Name: ref_kecamatan_ref_kec_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_kecamatan_ref_kec_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_kecamatan_ref_kec_id_seq OWNER TO postgres;

--
-- Name: ref_kecamatan_ref_kec_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_kecamatan_ref_kec_id_seq OWNED BY public.ref_kecamatan.ref_kec_id;


--
-- Name: ref_kelurahan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_kelurahan (
    ref_kel_id integer NOT NULL,
    ref_kel_label character varying,
    ref_kel_kec_id integer
);


ALTER TABLE public.ref_kelurahan OWNER TO postgres;

--
-- Name: ref_kelurahan_ref_kel_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_kelurahan_ref_kel_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ref_kelurahan_ref_kel_id_seq OWNER TO postgres;

--
-- Name: ref_kelurahan_ref_kel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_kelurahan_ref_kel_id_seq OWNED BY public.ref_kelurahan.ref_kel_id;


--
-- Name: ref_modul_akses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_modul_akses (
    ref_modul_akses_id integer NOT NULL,
    ref_modul_akses_label character varying(255),
    ref_modul_akses_group_id integer
);


ALTER TABLE public.ref_modul_akses OWNER TO postgres;

--
-- Name: ref_modul_akses_ref_modul_akses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_modul_akses_ref_modul_akses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.ref_modul_akses_ref_modul_akses_id_seq OWNER TO postgres;

--
-- Name: ref_modul_akses_ref_modul_akses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_modul_akses_ref_modul_akses_id_seq OWNED BY public.ref_modul_akses.ref_modul_akses_id;


--
-- Name: ref_user_akses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ref_user_akses (
    ref_user_akses_id integer NOT NULL,
    ref_user_akses_user_id integer,
    ref_user_akses_group_id integer
);


ALTER TABLE public.ref_user_akses OWNER TO postgres;

--
-- Name: ref_user_akses_ref_user_akses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ref_user_akses_ref_user_akses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.ref_user_akses_ref_user_akses_id_seq OWNER TO postgres;

--
-- Name: ref_user_akses_ref_user_akses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ref_user_akses_ref_user_akses_id_seq OWNED BY public.ref_user_akses.ref_user_akses_id;


--
-- Name: survey; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.survey (
    survey_id integer NOT NULL,
    survey_nomor integer,
    survey_nomor_lengkap character varying(255),
    survey_dasar character varying(255),
    survey_untuk character varying(255),
    survey_keterangan text,
    survey_tanggal date,
    survey_ttd_kar_id integer,
    survey_created_by integer,
    survey_created_at timestamp(6) without time zone
);


ALTER TABLE public.survey OWNER TO postgres;

--
-- Name: survey_detail; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.survey_detail (
    survey_det_id integer NOT NULL,
    survey_det_kar_id integer,
    survey_det_created_at timestamp without time zone,
    survey_det_created_by integer,
    survey_det_head_id integer
);


ALTER TABLE public.survey_detail OWNER TO postgres;

--
-- Name: survey_detail_survey_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.survey_detail_survey_det_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.survey_detail_survey_det_id_seq OWNER TO postgres;

--
-- Name: survey_detail_survey_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.survey_detail_survey_det_id_seq OWNED BY public.survey_detail.survey_det_id;


--
-- Name: survey_hasil; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.survey_hasil (
    survey_hasil_id integer NOT NULL,
    survey_hasil_survey_id integer,
    survey_hasil_peng_id integer,
    survey_hasil_1_perijinan character varying(255),
    survey_hasil_1_nilai_kes_usp character varying(255),
    survey_hasil_1_rat character varying(255),
    survey_hasil_1_jml_angg_produktif integer,
    survey_hasil_1_jml_angg integer,
    survey_hasil_2_modal_sendiri bigint,
    survey_hasil_2_modal_luar bigint,
    survey_hasil_3_usaha character varying(255),
    survey_hasil_3_omset_per_tahun bigint,
    survey_hasil_3_pendptn_per_tahun bigint,
    survey_hasil_3_beban_operasional bigint,
    survey_hasil_3_shu bigint,
    survey_hasil_4_kas_per_bulan bigint,
    survey_hasil_4_pengeluaran bigint,
    survey_hasil_4_saldo bigint,
    survey_hasil_5_jaminan character varying(255),
    survey_hasil_5_taksiran_harga bigint,
    survey_hasil_5_status_jaminan character varying(255),
    survey_hasil_6_kelangsungan_hidup character varying(255),
    survey_hasil_permasalahan character varying(255),
    survey_hasil_created_at timestamp(6) without time zone,
    survey_hasil_created_by integer,
    survey_hasil_1_status character varying(255),
    survey_hasil_lock_is boolean DEFAULT false,
    survey_hasil_lock_at timestamp(6) without time zone,
    survey_hasil_lock_by integer,
    survey_hasil_approve_is boolean,
    survey_hasil_approve_at timestamp(6) without time zone,
    survey_hasil_approve_by integer,
    survey_hasil_reject_is boolean,
    survey_hasil_reject_at timestamp(6) without time zone,
    survey_hasil_reject_by integer
);


ALTER TABLE public.survey_hasil OWNER TO postgres;

--
-- Name: survey_hasil_survey_hasil_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.survey_hasil_survey_hasil_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.survey_hasil_survey_hasil_id_seq OWNER TO postgres;

--
-- Name: survey_hasil_survey_hasil_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.survey_hasil_survey_hasil_id_seq OWNED BY public.survey_hasil.survey_hasil_id;


--
-- Name: survey_survey_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.survey_survey_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.survey_survey_id_seq OWNER TO postgres;

--
-- Name: survey_survey_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.survey_survey_id_seq OWNED BY public.survey.survey_id;


--
-- Name: survey_tempat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.survey_tempat (
    survey_tem_id integer NOT NULL,
    survey_tem_head_id integer,
    survey_tem_peng_id integer
);


ALTER TABLE public.survey_tempat OWNER TO postgres;

--
-- Name: survey_tempat_survey_tem_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.survey_tempat_survey_tem_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.survey_tempat_survey_tem_id_seq OWNER TO postgres;

--
-- Name: survey_tempat_survey_tem_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.survey_tempat_survey_tem_id_seq OWNED BY public.survey_tempat.survey_tem_id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    user_id integer NOT NULL,
    user_name character varying,
    user_password character varying(255),
    user_kar_id integer,
    user_disable boolean,
    user_created_at timestamp(6) without time zone,
    user_namalengkap character varying(255),
    user_member_id integer
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.user_user_id_seq OWNER TO postgres;

--
-- Name: user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_user_id_seq OWNED BY public."user".user_id;


--
-- Name: karyawan kar_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.karyawan ALTER COLUMN kar_id SET DEFAULT nextval('public.karyawan_kar_id_seq'::regclass);


--
-- Name: member member_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member ALTER COLUMN member_id SET DEFAULT nextval('public.member_member_id_seq'::regclass);


--
-- Name: pembayaran pembayaran_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayaran ALTER COLUMN pembayaran_id SET DEFAULT nextval('public.pembayaran_pembayaran_id_seq'::regclass);


--
-- Name: pengajuan peng_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan ALTER COLUMN peng_id SET DEFAULT nextval('public.pengajuan_peng_id_seq'::regclass);


--
-- Name: pengajuan_foto peng_foto_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan_foto ALTER COLUMN peng_foto_id SET DEFAULT nextval('public.pengajuan_foto_peng_foto_id_seq'::regclass);


--
-- Name: ref_approval ref_approval_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_approval ALTER COLUMN ref_approval_id SET DEFAULT nextval('public.ref_approval_ref_approval_id_seq'::regclass);


--
-- Name: ref_bidang_usaha ref_bidang_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_bidang_usaha ALTER COLUMN ref_bidang_id SET DEFAULT nextval('public.ref_bidang_usaha_ref_bidang_id_seq'::regclass);


--
-- Name: ref_group_akses ref_group_akses_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_group_akses ALTER COLUMN ref_group_akses_id SET DEFAULT nextval('public.ref_group_akses_ref_group_akses_id_seq'::regclass);


--
-- Name: ref_jaminan ref_jaminan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_jaminan ALTER COLUMN ref_jaminan_id SET DEFAULT nextval('public.ref_jaminan_ref_jaminan_id_seq'::regclass);


--
-- Name: ref_jenis_jaminan jns_jam_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_jenis_jaminan ALTER COLUMN jns_jam_id SET DEFAULT nextval('public.jenis_jaminan_jns_jam_id_seq'::regclass);


--
-- Name: ref_jenis_pengajuan jns_pengajuan_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_jenis_pengajuan ALTER COLUMN jns_pengajuan_id SET DEFAULT nextval('public.ref_jenis_pengajuan_jns_pengajuan_id_seq'::regclass);


--
-- Name: ref_kecamatan ref_kec_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_kecamatan ALTER COLUMN ref_kec_id SET DEFAULT nextval('public.ref_kecamatan_ref_kec_id_seq'::regclass);


--
-- Name: ref_kelurahan ref_kel_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_kelurahan ALTER COLUMN ref_kel_id SET DEFAULT nextval('public.ref_kelurahan_ref_kel_id_seq'::regclass);


--
-- Name: ref_modul_akses ref_modul_akses_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_modul_akses ALTER COLUMN ref_modul_akses_id SET DEFAULT nextval('public.ref_modul_akses_ref_modul_akses_id_seq'::regclass);


--
-- Name: ref_user_akses ref_user_akses_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_user_akses ALTER COLUMN ref_user_akses_id SET DEFAULT nextval('public.ref_user_akses_ref_user_akses_id_seq'::regclass);


--
-- Name: survey survey_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey ALTER COLUMN survey_id SET DEFAULT nextval('public.survey_survey_id_seq'::regclass);


--
-- Name: survey_detail survey_det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey_detail ALTER COLUMN survey_det_id SET DEFAULT nextval('public.survey_detail_survey_det_id_seq'::regclass);


--
-- Name: survey_hasil survey_hasil_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey_hasil ALTER COLUMN survey_hasil_id SET DEFAULT nextval('public.survey_hasil_survey_hasil_id_seq'::regclass);


--
-- Name: survey_tempat survey_tem_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey_tempat ALTER COLUMN survey_tem_id SET DEFAULT nextval('public.survey_tempat_survey_tem_id_seq'::regclass);


--
-- Name: user user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN user_id SET DEFAULT nextval('public.user_user_id_seq'::regclass);


--
-- Data for Name: karyawan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.karyawan (kar_id, kar_nama, kar_nip, kar_pangkat, kar_jabatan, kar_created_at, kar_created_by, kar_visible) FROM stdin;
2	HUSNAWATI,S.Sos	19751120 199803 2 003	Penata /IIIc	Staf P3KUM	2020-11-20 09:47:41.15766	1	t
1	PATRIA HADI WIJAYA,SH	19820915 200312 1 004	Penata Muda Tk I / III b	kasi Pembiayaan Koperasi Dan Usaha Mikro P3KUM	2020-11-20 09:45:15.042906	1	t
\.


--
-- Data for Name: member; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.member (member_id, member_nama_lengkap, member_alamat, member_no_telp, member_kelurahan, member_created_at, member_created_by, member_updated_by, member_updated_at, member_visible) FROM stdin;
17	yusuf	kediri	0858585	lirboyo	2020-10-23 15:48:26.280736	\N	\N	\N	\N
18	yusuf	kediri	0988	kediri	2020-10-24 09:56:41.298859	\N	\N	\N	\N
32	mohammad almi kurniawan	kediri	08765432	jabon	2020-11-06 15:08:25.827111	\N	\N	\N	t
\.


--
-- Data for Name: pembayaran; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pembayaran (pembayaran_id, pembayaran_peng_id, pembayaran_tanggal, pembayaran_cicilan, pembayaran_ke, pembayaran_lunas_is, pembayaran_lunas_tanggal) FROM stdin;
133	13	2020-12-01	100000	1	t	\N
134	13	2021-01-01	100000	2	\N	\N
135	13	2021-02-01	100000	3	\N	\N
136	13	2021-03-01	100000	4	\N	\N
137	13	2021-04-01	100000	5	\N	\N
138	13	2021-05-01	100000	6	\N	\N
139	13	2021-06-01	100000	7	\N	\N
140	13	2021-07-01	100000	8	\N	\N
141	13	2021-08-01	100000	9	\N	\N
142	13	2021-09-01	100000	10	\N	\N
143	13	2021-10-01	100000	11	\N	\N
144	13	2021-11-01	100000	12	\N	\N
\.


--
-- Data for Name: pengajuan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengajuan (peng_id, peng_tanggal, peng_bidang_usaha, peng_jenis_pengajuan, peng_tujuan_penggunaan, peng_foto_suami, peng_foto_istri, peng_fc_ktp, peng_fc_kk, peng_fc_surat_nikah, peng_fc_legalitas_jaminan, peng_member_id, peng_nominal, peng_prof_nama_usaha, peng_prof_alamat, peng_prof_pimpinan, peng_prof_perizinan, peng_prof_jumlah_karyawan, peng_prof_tahun_mulai, peng_prof_jenis_usaha, peng_prof_komoditi_produk, peng_prof_omset_per_bulan, peng_prof_lokasi_pemasaran, peng_prof_pola_pemasaran, peng_prof_pendapatan_penjualan, peng_prof_beban_penjualan, peng_prof_laba_per_bulan, peng_prof_modal_sendiri, peng_prof_modal_luar, peng_sk_kepala_kelurahan, peng_sk_kecamatan, peng_sk_kota, peng_sk_tanah_luas, peng_sk_tanah_desa, peng_sk_tanah_kecamatan, peng_sk_tanah_no_shm, peng_sk_tanah_tanggal_shm, peng_sk_tanah_atas_nama, peng_sk_tanah_harga_ru, peng_sk_tanah_harga_meter, peng_sk_tanah_luas_bangunan, peng_sk_tanah_harga_bangunan, peng_sk_tanah_letak_utara, peng_sk_tanah_letak_selatan, peng_sk_tanah_letak_timur, peng_sk_tanah_letak_barat, peng_sk_tanah_penggunaan, peng_jam_pemegang_ktp_no, peng_jam_pekerjaan, peng_jam_tahun_pembuatan, peng_jam_nopol, peng_jam_mesin, peng_jam_rangka, peng_jam_atas_nama, peng_jam_alamat, peng_jam_no_akta, peng_jam_tempat, peng_jam_atas_nama_tanah, peng_jam_alamat_tanah, peng_jam_jenis_bpkb, peng_jam_jenis_tanah, peng_lokasi_lat, peng_lokasi_lon, peng_lokasi_keterangan, peng_no_hp, peng_no_telp, peng_no_ktp, peng_srt_nama, peng_srt_pekerjaan, peng_srt_nama_usaha, peng_srt_jenis_usaha, peng_srt_alamat, peng_srt_jumlah_pinjaman, peng_srt_modal_kerja, peng_srt_investasi, peng_srt_pengambilan_waktu, peng_srt_bunga, peng_srt_omset_penjualan_pokok, peng_srt_pendapatan_lain, peng_srt_harga_pokok_penjualan, peng_srt_beban_bunga, peng_srt_beban_usaha, peng_srt_beban_non_usaha, peng_srt_laba, peng_lock_is, peng_lock_at, peng_lock_by, peng_tempat, peng_susunan_pengurus, peng_fc_akta_pendirian, peng_fc_buku_laporan_rapat, peng_fc_jaminan, peng_fc_ktp_pengurus, peng_fc_ktp_pengawas, peng_fc_siup, peng_fc_tdp, peng_fc_npwp, peng_fc_sertifikat_penilaian, peng_foto_pengawas, peng_foto_pengurus, peng_badan_hukum_no, peng_badan_hukum_tanggal, peng_kesehatan_usp, peng_jumlah_anggota, peng_pelaksanaan_rat, peng_ketua, peng_sekretaris, peng_bendahara, peng_pengawas_koor, peng_pengawas_anggota1, peng_pengawas_anggota2, peng_usaha_dikelola_1, peng_usaha_dikelola_2, peng_jam_jenis, peng_usaha_shu, peng_permodalan_kewajiban, peng_permodalan_modal_kerja, peng_permodalan_pinjaman_bank, peng_manf_meningkatkan_penjualan, peng_manf_menambah_modal, peng_manf_peningkatan_omset, peng_manf_peningkatan_shu, peng_manf_peningkatan_asset, peng_verif_is, peng_verif_by, peng_verif_at, peng_verif_reject_is, peng_verif_reject_by, peng_verif_reject_at, peng_verif_reject_note, peng_surv_is, peng_surv_id, peng_disetujui_nominal, peng_disetujui_tanggal_jatuh_tempo, peng_disetujui_tanggal_penetapan, peng_disetujui_jangka_waktu_bln, peng_disetujui_jangka_waktu_text, peng_disetujui_cicilan, peng_disetujui_created_at, peng_disetujui_created_by) FROM stdin;
10	2020-11-06	\N	2	modal	1604650978_8ed09b3b7fc8612755e1.jpg.jpg	1604650978_01962f7f7120e566de89.jpg.jpg	1604650978_7d72a2817dfdff515cb9.jpg.jpg	1604650978_8eb560271130a05bc456.jpg.jpg	1604650978_557f18dd5df5224a8c05.jpg.jpg	1604650978_2856b8141ee7a158b0e2.jpg.jpg	32	23000000	pecel lele almi	kediri	almi	tes123	100	2019	\N	makanan	10000000	kediri dan sekitarnya	offline dan online	\N	\N	\N	1000000	1000000	almi	\N	KEDIRI	30	jabon	banyakan	tes123	2020-11-19	almi	100000	100000	100	1000000	tes	tes	tes	tes	tes	123	swasta	2019	tes123	tes123	tes123	almi kruniawan	kediri	tes123	tes123	tes123	tes123	1	1	\N	\N	\N	\N	\N	\N	almi kurniawan	swasta	pecel lele almi	\N	kediri	1000000	1000000	1000000	123	1000	1000000	1000000	1000000	100000	100000	1000000	100000000	f	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	1	2020-11-13 20:59:41	ts	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
13	2020-11-06	\N	3	\N	\N	\N	\N	\N	\N	\N	17	57000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	1231423	wirausaha	\N	\N	\N	\N	\N	\N	123	kediri	almi	kediri	\N	1	-7.821568440250536	112.06311350830077	tes	\N	\N	\N	\N	\N	\N	\N	\N	57000000	10000	10000	1	10000	10000	10000	10000	10000	10000	10000	10000	t	2020-11-13 02:33:33	1	kediri	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2	\N	\N	\N	\N	10000	10000	10000	10000	10000	t	1	2020-11-13 21:11:36	\N	\N	\N	\N	t	24	1000000	2020-12-01	2020-12-03	12	Bulan	100000	2020-12-02 14:31:48	6
3	2020-10-31	\N	1	modal	1603509290_48927043fb58bd0de462.webp.webp	1603509290_1de85623baea261b8170.jpg.jpg	1603509290_6ed2a5acc3219979a9a9.jpg.jpg	1603509290_b861f4e4b42733998c0f.jpg.jpg	1603509290_6efa7b3bafd784b9df57.jpg.jpg	1603509290_b8ebbb022fcebadc7921.jpg.jpg	17	500000	tes	tes	tes	tes	100	2019	\N	tes	1000	tes	tes	\N	\N	\N	10000000	5000000	\N	\N	KEDIRI	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	f	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	1	2020-11-13 21:11:41	hgfhg	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
5	2020-10-30	\N	2	modal	1604043110_387c7a4698b8bd13954f.jpg.jpg	1604043110_b9efdbfa8832410f373f.jpg.jpg	1604043110_d1a8e37588d1b514582b.jpg.jpg	1604043110_b944da009f296ca9a3ac.jpg.jpg	1604043110_c064611870e587d9efac.jpg.jpg	1604043110_89ad777c21f35f0aa7a9.jpg.jpg	17	49000000	tes	tes	almi kurniawan	tes	100	2019	\N	lele	100000000	kediri dan sekitarnya	internet	\N	\N	\N	1000000000	500000000	almi	\N	KEDIRI	90	manukan	banyakan	12542534	2020-10-26	almi	70000	50000	90	90000	sungai	sungai	sungai	sungai	tes	1242367	Wirausaha	2019	08856576	r9987698	76986988	Almi	kediri	1252653472	kediri	almi	kediri	1	2	-7.799489411170418	112.10423139746091	tes	\N	\N	\N	almi	tukang sapu	karaoke top 99	\N	kediri	100000	100000	100000	4	100000	100000	100000	100000	100000	100000	100000	100000	f	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	1	2020-11-13 20:59:35	kurang jelas, jaminan tidak ada	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
7	2020-11-05	1	1	modal	1605164353_86469b8a339bced60296.pdf.pdf	1604306102_7b66de595efb5ba5e81a.png.png	1604306102_58ad519384e47bb2e60f.jpg.jpg	1604306102_c8d2714013fb8915a3d8.jpg.jpg	1604306102_62678a2d4223a0da71ea.jpg.jpg	1604306102_af404a498648776465a8.jpg.jpg	17	10000000	tes	tes	tes	tes	10	2019	\N	tes	100000	tes	tes	90000	900000	9900000	100000000	500000	ALMI	1	KEDIRI	20	MANUKAN	banyakan	57123169	2020-11-12	almi	2000000	1000000	20	20000000	masjid	masjid	masjid	masjid	untuk tempat tinggal	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	f	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	1	2020-11-13 21:04:41	kurang jelas, jaminan tidak ada	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
9	2020-11-06	\N	1	tambahan modal	1604650295_8261967d7919ce3f1ec9.jpg.jpg	1604650295_23d63984ddc056339471.jpg.jpg	1604650295_b3dc800967733d4aecc5.jpg.jpg	1604650295_1093a2e74186f8fbc1fa.jpg.jpg	1604650295_98cbcee6b6ba5768cc32.jpg.jpg	1604650295_4de69a5867efa667fd53.jpg.jpg	17	8000000	pecel lele yusuf	kediri	yusuf	tes123	10	2019	\N	makanan	10000000	jl. dhoho	offline	\N	\N	\N	5000000	5000000	Almi Kurniawan	\N	KEDIRI	30	jabon	banyakan	tes123	2020-11-12	almi kurniawan	10000000	7000000	25	300000000	masjid	sungai	rumah	jalan	untuk tempat tinggal saja	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	2020-11-06 02:18:03	1	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	1	2020-11-13 21:04:45	\N	\N	\N	\N	t	24	\N	\N	\N	\N	\N	\N	\N	\N
6	2020-10-29	\N	1	modal	1604044411_51eb31fff8f152f9fdb7.jpg.jpg	1604044411_f421eef7d1a17e67885b.jpg.jpg	1604044411_c8139217732c4dfa0f38.jpg.jpg	1604044411_cc568599582d840361c2.jpg.jpg	1604044411_7c32ed6367f5548713eb.jpg.jpg	1604044411_b853161be63f073f9c10.jpg.jpg	17	5000000	mie ayam	Kediri	almi kurniaan	123566	4	2019	\N	mie	1000000	kediri dan sekitarnya	mulut ke mulut	\N	\N	\N	5000000	0	\N	\N	KEDIRI	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
8	2020-11-06	\N	3	\N	\N	\N	\N	\N	\N	\N	17	57000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	KEDIRI	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	kediri	1604647164_16ff775a72537d4850db.jpg.jpg	1604647164_730afff939c74242c197.jpg.jpg	1604647164_95f40719ee3efd069832.jpg.jpg	1604647164_0fae1b964d19e3ed2735.jpg.jpg	1604647164_84027199d1c461063811.jpg.jpg	1604647164_709699c5b99ab5755744.jpg.jpg	1604647164_5e75f08faf03e3371a2b.jpg.jpg	1604647164_7276fd30f40b8086cc5b.jpg.jpg	1604647164_194a22615b04f542fce8.jpg.jpg	1604647164_a0e873743d54d6d21afb.jpg.jpg	1604647164_addb93e60cc8deaad8d8.jpg.jpg	1604647164_fe57b76eb69507236fe6.jpg.jpg	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
11	2020-11-12	1	2	modal	1605165428_aba2361a59e54c6318dd.png.png	1605165428_94349065dd1c8b6e5ce0.png.png	1605165428_b932998813b4eb0033b2.pdf.pdf	1605165428_e91dda5c2e5bee120db8.pdf.pdf	1605165428_f9ff438b23b13de0dcc8.pdf.pdf	1605165428_ffac828f33c167475885.pdf.pdf	32	100000000	Pecel lele mas almi	kediri	almi	16212	10	2021	1	makanan	1000000	kediri kota	mulut ke mulut	100000	100000	10000000	10000000	10000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	3506	Wiraswasta	\N	\N	\N	\N	\N	\N	tes123	kediri	almi	kediri	\N	1	-7.812725	112.014705	tes	\N	\N	\N	\N	\N	\N	\N	\N	100000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
12	2020-11-13	\N	3	\N	\N	\N	\N	\N	\N	\N	17	10000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	10000000	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	Kediri	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
4	2020-11-02	\N	1	tambah purel	1603522933_d62b9c275926f0cc9046.jpg.jpg	1603522933_c77f7ed39edeeb7d1685.jpg.jpg	1603522933_c70856e78547f3aec75b.jpg.jpg	1603522933_69bd72caec184b5451c5.jpg.jpg	1603522933_75de871e01705e2a1e69.jpg.jpg	1603522933_c31ec38c2a699b83d0d1.jpg.jpg	17	500000	Jualan ayam	tes	almi kurniawan	tes	100	2019	\N	segala jenis ayam	50000000	tes	tes	\N	\N	\N	10000000	5000000	tes	\N	KEDIRI	1000	tes	tes	12748	2020-10-24	tes	1000000	200000	100	100	tes	tes	tes	tes	tes	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	t	2020-11-02 02:21:02	1	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- Data for Name: pengajuan_foto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pengajuan_foto (peng_foto_id, peng_foto_peng_id, peng_foto_file, peng_foto_created_at, peng_foto_created_by, peng_foto_jenis) FROM stdin;
7	10	1604651261_51898aba1b88fd889063.jpg	2020-11-06 02:27:41	1	1
10	13	1605253251_c9960aa1529a904cc193.jpg	2020-11-13 01:40:51	1	1
1	5	1603856337_b814ad5b948a54a0ff96.jpg	2020-10-27 22:38:57	1	2
2	5	1603856359_f3346f9ad01b675e2e26.jpg	2020-10-27 22:39:19	1	2
3	5	1603856391_5b433f4b4e2216089179.jpg	2020-10-27 22:39:51	1	2
11	5	1605944051_16ed32e97961faac4e8d.jpg	2020-11-21 01:34:11	1	2
\.


--
-- Data for Name: ref_approval; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_approval (ref_approval_id, ref_approval_label) FROM stdin;
\.


--
-- Data for Name: ref_bidang_usaha; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_bidang_usaha (ref_bidang_id, ref_bidang_label) FROM stdin;
1	Kuliner
2	Peternakan
3	Pertanian
4	Jasa
\.


--
-- Data for Name: ref_group_akses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_group_akses (ref_group_akses_id, ref_group_akses_label) FROM stdin;
\.


--
-- Data for Name: ref_jaminan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_jaminan (ref_jaminan_id, ref_jaminan_label) FROM stdin;
\.


--
-- Data for Name: ref_jenis_jaminan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_jenis_jaminan (jns_jam_id, jns_jam_label) FROM stdin;
1	Pribadi
2	Orang Lain
\.


--
-- Data for Name: ref_jenis_pengajuan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_jenis_pengajuan (jns_pengajuan_id, jns_pengajuan_label) FROM stdin;
1	Dibawah 10jt
2	Diatas 10jt
3	Dana Bergulir
\.


--
-- Data for Name: ref_kecamatan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_kecamatan (ref_kec_id, ref_kec_label) FROM stdin;
1	MOJOROTO
2	KOTA
3	PESANTREN
\.


--
-- Data for Name: ref_kelurahan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_kelurahan (ref_kel_id, ref_kel_label, ref_kel_kec_id) FROM stdin;
1	MOJOROTO	1
\.


--
-- Data for Name: ref_modul_akses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_modul_akses (ref_modul_akses_id, ref_modul_akses_label, ref_modul_akses_group_id) FROM stdin;
\.


--
-- Data for Name: ref_user_akses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ref_user_akses (ref_user_akses_id, ref_user_akses_user_id, ref_user_akses_group_id) FROM stdin;
\.


--
-- Data for Name: survey; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.survey (survey_id, survey_nomor, survey_nomor_lengkap, survey_dasar, survey_untuk, survey_keterangan, survey_tanggal, survey_ttd_kar_id, survey_created_by, survey_created_at) FROM stdin;
24	\N	\N	\N	\N	\N	\N	\N	1	2020-11-20 22:54:52
22	\N	\N	tes	tes	tes	2020-11-21	\N	1	2020-11-20 20:24:15
\.


--
-- Data for Name: survey_detail; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.survey_detail (survey_det_id, survey_det_kar_id, survey_det_created_at, survey_det_created_by, survey_det_head_id) FROM stdin;
5	2	\N	\N	22
6	1	\N	\N	22
\.


--
-- Data for Name: survey_hasil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.survey_hasil (survey_hasil_id, survey_hasil_survey_id, survey_hasil_peng_id, survey_hasil_1_perijinan, survey_hasil_1_nilai_kes_usp, survey_hasil_1_rat, survey_hasil_1_jml_angg_produktif, survey_hasil_1_jml_angg, survey_hasil_2_modal_sendiri, survey_hasil_2_modal_luar, survey_hasil_3_usaha, survey_hasil_3_omset_per_tahun, survey_hasil_3_pendptn_per_tahun, survey_hasil_3_beban_operasional, survey_hasil_3_shu, survey_hasil_4_kas_per_bulan, survey_hasil_4_pengeluaran, survey_hasil_4_saldo, survey_hasil_5_jaminan, survey_hasil_5_taksiran_harga, survey_hasil_5_status_jaminan, survey_hasil_6_kelangsungan_hidup, survey_hasil_permasalahan, survey_hasil_created_at, survey_hasil_created_by, survey_hasil_1_status, survey_hasil_lock_is, survey_hasil_lock_at, survey_hasil_lock_by, survey_hasil_approve_is, survey_hasil_approve_at, survey_hasil_approve_by, survey_hasil_reject_is, survey_hasil_reject_at, survey_hasil_reject_by) FROM stdin;
1	24	9	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N
3	24	13	ijin	sehat	rat	9	10	1000000	10000000	ternak kambing	10000000	10000000000	1000000	\N	1000000	10000000	\N	mobil	120000000	milik sendiri	langsung	tidak ada	\N	\N	aktif	t	2020-11-30 15:01:32.864647	1	t	2020-12-01 14:55:05.702535	6	f	2020-12-01 14:53:57.408202	6
\.


--
-- Data for Name: survey_tempat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.survey_tempat (survey_tem_id, survey_tem_head_id, survey_tem_peng_id) FROM stdin;
7	22	9
10	24	9
11	24	13
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (user_id, user_name, user_password, user_kar_id, user_disable, user_created_at, user_namalengkap, user_member_id) FROM stdin;
15	yus	36c3eaa0e1e290f41e2810bae8d9502c785e92d9	0	\N	2020-10-23 15:39:55.106223	yusuf	18
19	almikurniawan	40bd001563085fc35165329ea1ff5c5ecbdbbeef	\N	\N	2020-11-06 15:08:25.874301	mohammad almi kurniawan	32
20	patria	40bd001563085fc35165329ea1ff5c5ecbdbbeef	1	\N	2020-11-20 09:45:15.074359	PATRIA HADI WIJAYA,SH	\N
21	husna	40bd001563085fc35165329ea1ff5c5ecbdbbeef	2	\N	2020-11-20 09:47:41.181877	HUSNAWATI,S.Sos	\N
6	yus	40bd001563085fc35165329ea1ff5c5ecbdbbeef	0	\N	\N	yusuf	17
3	wina	2fee5e53252cce3b7146551b6459fc99c3e28041	0	\N	\N	wina	\N
2	surveyor	d033e22ae348aeb5660fc2140aec35850c4da997	0	f	2020-09-16 10:34:30.089515	Almi	\N
1	admin	d033e22ae348aeb5660fc2140aec35850c4da997	0	f	2020-09-16 10:34:30.089515	Yusuf	\N
\.


--
-- Name: jenis_jaminan_jns_jam_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jenis_jaminan_jns_jam_id_seq', 2, true);


--
-- Name: karyawan_kar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.karyawan_kar_id_seq', 2, true);


--
-- Name: member_member_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.member_member_id_seq', 32, true);


--
-- Name: pembayaran_pembayaran_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pembayaran_pembayaran_id_seq', 144, true);


--
-- Name: pengajuan_foto_peng_foto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengajuan_foto_peng_foto_id_seq', 11, true);


--
-- Name: pengajuan_peng_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pengajuan_peng_id_seq', 13, true);


--
-- Name: ref_approval_ref_approval_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_approval_ref_approval_id_seq', 1, false);


--
-- Name: ref_bidang_usaha_ref_bidang_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_bidang_usaha_ref_bidang_id_seq', 4, true);


--
-- Name: ref_group_akses_ref_group_akses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_group_akses_ref_group_akses_id_seq', 4, true);


--
-- Name: ref_jaminan_ref_jaminan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_jaminan_ref_jaminan_id_seq', 1, false);


--
-- Name: ref_jenis_pengajuan_jns_pengajuan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_jenis_pengajuan_jns_pengajuan_id_seq', 3, true);


--
-- Name: ref_kecamatan_ref_kec_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_kecamatan_ref_kec_id_seq', 3, true);


--
-- Name: ref_kelurahan_ref_kel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_kelurahan_ref_kel_id_seq', 1, true);


--
-- Name: ref_modul_akses_ref_modul_akses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_modul_akses_ref_modul_akses_id_seq', 18, true);


--
-- Name: ref_user_akses_ref_user_akses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ref_user_akses_ref_user_akses_id_seq', 30, true);


--
-- Name: survey_detail_survey_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.survey_detail_survey_det_id_seq', 6, true);


--
-- Name: survey_hasil_survey_hasil_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.survey_hasil_survey_hasil_id_seq', 3, true);


--
-- Name: survey_survey_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.survey_survey_id_seq', 24, true);


--
-- Name: survey_tempat_survey_tem_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.survey_tempat_survey_tem_id_seq', 11, true);


--
-- Name: user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_user_id_seq', 21, true);


--
-- Name: ref_jenis_jaminan jenis_jaminan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_jenis_jaminan
    ADD CONSTRAINT jenis_jaminan_pkey PRIMARY KEY (jns_jam_id);


--
-- Name: karyawan karyawan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.karyawan
    ADD CONSTRAINT karyawan_pkey PRIMARY KEY (kar_id);


--
-- Name: member member_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.member
    ADD CONSTRAINT member_pkey PRIMARY KEY (member_id);


--
-- Name: pembayaran pembayaran_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembayaran
    ADD CONSTRAINT pembayaran_pkey PRIMARY KEY (pembayaran_id);


--
-- Name: pengajuan_foto pengajuan_foto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan_foto
    ADD CONSTRAINT pengajuan_foto_pkey PRIMARY KEY (peng_foto_id);


--
-- Name: pengajuan pengajuan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pengajuan
    ADD CONSTRAINT pengajuan_pkey PRIMARY KEY (peng_id);


--
-- Name: ref_bidang_usaha ref_bidang_usaha_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_bidang_usaha
    ADD CONSTRAINT ref_bidang_usaha_pkey PRIMARY KEY (ref_bidang_id);


--
-- Name: ref_group_akses ref_group_akses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_group_akses
    ADD CONSTRAINT ref_group_akses_pkey PRIMARY KEY (ref_group_akses_id);


--
-- Name: ref_jenis_pengajuan ref_jenis_pengajuan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_jenis_pengajuan
    ADD CONSTRAINT ref_jenis_pengajuan_pkey PRIMARY KEY (jns_pengajuan_id);


--
-- Name: ref_kecamatan ref_kecamatan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_kecamatan
    ADD CONSTRAINT ref_kecamatan_pkey PRIMARY KEY (ref_kec_id);


--
-- Name: ref_kelurahan ref_kelurahan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_kelurahan
    ADD CONSTRAINT ref_kelurahan_pkey PRIMARY KEY (ref_kel_id);


--
-- Name: ref_modul_akses ref_modul_akses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_modul_akses
    ADD CONSTRAINT ref_modul_akses_pkey PRIMARY KEY (ref_modul_akses_id);


--
-- Name: ref_user_akses ref_user_akses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ref_user_akses
    ADD CONSTRAINT ref_user_akses_pkey PRIMARY KEY (ref_user_akses_id);


--
-- Name: survey_detail survey_detail_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey_detail
    ADD CONSTRAINT survey_detail_pkey PRIMARY KEY (survey_det_id);


--
-- Name: survey_hasil survey_hasil_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.survey_hasil
    ADD CONSTRAINT survey_hasil_pkey PRIMARY KEY (survey_hasil_id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (user_id);


--
-- PostgreSQL database dump complete
--

