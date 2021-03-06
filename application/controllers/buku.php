<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {
	function simpan_pasok ()
	{
		$judul = $this->input->post('judul');
		$stok = $this->input->post('stok');
		$id_distributor = $this->input->post('id_distributor');
		$jumlah = $this->input->post('jumlah');
		$tanggal = $this->input->post('tanggal');
		$stokupdate = $jumlah + $stok;
		$id_buku = $this->input->post('id_buku');

		$input_distributor=array(
					'id_buku'		=> $id_buku,
					'id_distributor'=> $id_distributor,
					'jumlah'		=> $jumlah, 
					'tanggal'		=> $tanggal, 
					);

		$primary_key=array(
					'id_buku' => $id_buku,
			);
		$update_stok=array(
					'stok' 	=> $stokupdate,
			);

		$this->Mbuku->simpan_pasokan($input_distributor);
		$this->Mbuku->stok_update($update_stok,$primary_key);

		redirect('admin/data_buku');

	}

	function hapus_buku($id_buku)
	{
		$data['id_buku']=$id_buku;
		
		$this->Mbuku->hapus_buku($data);
		redirect('admin/data_buku');
	}

	function tambah_buku ()
	{
		$judul = $this->input->post('judul');
		$noisbn = $this->input->post('noisbn');
		$penulis = $this->input->post('penulis');
		$penerbit = $this->input->post('penerbit');
		$tahun = $this->input->post('tahun');
		$stok = $this->input->post('stok');
		$harga_jual = $this->input->post('harga_jual');
		$jml_ppn = 0.1;
	
		$ppn = $harga_jual * $jml_ppn;
		$diskon = $this->input->post('diskon');
		$harga_pokok = $harga_jual + $ppn - $diskon;
		$input=array(
					'judul'			=> $judul, 
					'noisbn'		=> $noisbn, 
					'penulis'		=> $penulis, 
					'penerbit'		=> $penerbit, 
					'tahun'			=> $tahun, 
					'stok'			=> $stok, 
					'harga_pokok'	=> $harga_pokok, 
					'harga_jual'	=> $harga_jual, 
					'ppn'			=> $ppn, 
					'diskon'		=> $diskon
					);

		$this->Mbuku->addBuku($input);
		redirect('admin/data_buku');

	}

	function simpan_edit_buku ()
	{
		$id_buku = $this->input->post('id_buku');
		$judul = $this->input->post('judul');
		$noisbn = $this->input->post('noisbn');
		$penulis = $this->input->post('penulis');
		$penerbit = $this->input->post('penerbit');
		$tahun = $this->input->post('tahun');
		$stok = $this->input->post('stok');
		$harga_jual = $this->input->post('harga_jual');
		$jml_ppn = 0.1;
	
		$ppn = $harga_jual * $jml_ppn;
		$diskon = $this->input->post('diskon');
		$harga_pokok = $harga_jual + $ppn - $diskon;

		$primary_key = array(
					'id_buku' 		=> $id_buku
			);

		$update=array(
					'id_buku'		=> $id_buku,
					'judul'			=> $judul, 
					'noisbn'		=> $noisbn, 
					'penulis'		=> $penulis, 
					'penerbit'		=> $penerbit, 
					'tahun'			=> $tahun, 
					'stok'			=> $stok, 
					'harga_pokok'	=> $harga_pokok, 
					'harga_jual'	=> $harga_jual, 
					'ppn'			=> $ppn, 
					'diskon'		=> $diskon
					);

		$this->Mbuku->simpan_editBuku($update,$primary_key);
		redirect('admin/data_buku');

	}
}