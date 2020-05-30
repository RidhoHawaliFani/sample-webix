<?php
Class Home_model extends CI_Model{
	function __construct(){
            parent::__construct();
            //load our second db and put in $db2
            $this->db2 = $this->load->database('second', TRUE);
    }

	public function getData($tableName, $where){
		$result = $this->db->query("select * from $tableName $where");
		return $result;
	}

	public function getRate($tableName, $where){
		$result = $this->db->query("select round($tableName,1) rerata from $where");
		return $result->row()->rerata;
	}

	public function getRateMentor($tableName, $where, $kondisi){
		$result = $this->db->query("select round($tableName,1) rerata from $where $kondisi");
		return $result->row()->rerata;
	}

	public function getDataLevelUser($tableName, $where){
		$result = $this->db->query("select statusLevelUser level from $tableName $where");
		return $result->row()->level;
	}

	public function getDataLevelUserRoot($tableName, $where){
		$result = $this->db->query("select statusUser userRoot from $tableName $where");
		return $result->row()->userRoot;
	}

	public function cekPeRating($penilai, $terimaNilai){
		$query = $this->db->query("select * from ratinguser where idPenilai='$penilai' && idPenerimaNilai='$terimaNilai' limit 1");
	    if($query->num_rows() > 0){
			return $query->result();
	    }else{
			return false;
	    }
	}
	
	public function getDataCount($column, $tableName, $where){
		$result = $this->db->query("select count($column) jumlah from $tableName $where");
		return $result->row()->jumlah;
	}

	
	public function insertData($tableName, $data){
		$result = $this->db->insert($tableName, $data);
		return $result;
	}

	public function insertData2nd($tableName, $data){
		$result = $this->db2->insert($tableName, $data);
		return $result;
	}

	public function updateData($tableName, $data, $where){
		$result = $this->db->update($tableName, $data, $where);
		return $result;
	}
	public function updateData2nd($tableName, $data, $where){
		$result = $this->db2->update($tableName, $data, $where);
		return $result;
	}
	public function updateTemporaryTargetInvest($tableName, $data, $where){
		$result = $this->db->query("update $tableName set temporaryTargetInvest=temporaryTargetInvest+$data $where");
		return $result;
	}

	public function updateSaldoMasuk($where1,$where2,$Uangnya,$tglNya){
		$this->db->where('id_identitas', $where1);
		$this->db->where('id_invest', $where2);
		$this->db->set('tgl_saldokas', "$tglNya");
		$this->db->set('saldoMasuk', 'saldoMasuk +'."$Uangnya", FALSE);
		$this->db->update('saldokas');
	}
	public function updateSaldoMasuk2nd($where1,$where2,$Uangnya){
		$this->db2->where('id_identitas', $where1);
		$this->db2->where('id_invest', $where2);
		$this->db2->set('saldoMasuk', 'saldoMasuk +'."$Uangnya", FALSE);
		$this->db2->update('saldokas');
	}

	public function updateSaldoDicairkan($where1,$where2,$Uangnya){
		$this->db->where('id_identitas', $where1);
		$this->db->where('id_invest', $where2);
		
		$this->db->set('saldoMasuk', 'saldoMasuk -'."$Uangnya", FALSE);
		$this->db->update('saldokas');
	}

	public function updateRating($totalSkor, $kondisi){
		$result = $this->db->query("update ratinguser set totalSkor = $totalSkor WHERE $kondisi ");
		return $result;
	}

	public function deleteData($tableName, $where){
		$result = $this->db->delete($tableName, $where);
		return $result;
	}

	public function countUser(){
		$this->db->select('id_identitas');
		$this->db->where("statusUser = '0'");
		$result = $this->db->count_all_results('identitas');
		return $result;
	}

	public function countClassificationItem($idToko){
		$this->db->select('idInvKlasifikasi');
		$this->db->where('idToko', $idToko);
		$result = $this->db->count_all_results('inventory_klasifikasi');
		return $result;
	}

	public function countLuas(){
		$this->db->select_sum('spaciousPond');
		$this->db->where("targetinvest.statusTargetInvest = 'A'");
		$result = $this->db->get('targetinvest')->row()->spaciousPond;
		return $result;
	}

	public function countInvest2($id){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'A'");
		$this->db->where("invest.id_targetInvest = '$id'");
		$result = $this->db->get('invest')->row()->money;
		return $result;
	}

	public function countSahamInvest($users){
		$this->db->select_sum('saham_invest');
		
		$this->db->where("invest.id_identitas = '$users'");
		$result = $this->db->get('invest')->row()->saham_invest;
		return $result;
	}

	

	public function countInvest(){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'N'");
		$result = $this->db->get('invest')->row()->money;
		return $result;
	}

	

	public function countInvestTambak(){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'A'");
		$this->db->where("invest.id_targetInvest = targetinvest.id_targetInvest");
		$this->db->where("targetinvest.statusTargetInvest = 'A'");
		$result = $this->db->get('invest, targetInvest')->row()->money;
		return $result;
	}

	public function countPenambak(){
		$this->db->select('fishFarmer');
		$result = $this->db->count_all_results('targetinvest');
		return $result;
	}

	public function email($username){
		$result = $this->db->query("select email from identitas where username = '$username'");
		return $result;
	}

	public function getMoney($tableName, $where){
		$result = $this->db->query("select * from $tableName $where");
		return $result;
	}

	public function updateTambak($id_tambak, $uang){
		$result = $this->db->query("update targetinvest set temporaryTargetInvestment = '$uang' WHERE statusTambak = 'A' AND id_tambak = '$id_tambak' ");
		return $result;
	}

	public function getSelectData($select, $tableName, $where){
		$result = $this->db->query("select $select from $tableName $where");
		return $result;
	}

	public function getSelectData2nd($select, $tableName, $where){
		$result = $this->db2->query("select $select from $tableName $where");
		return $result;
	}

	public function selectItemModel($idInvKlasifikasi)
	 {
	  $this->db->where('idInvKlasifikasi', $idInvKlasifikasi);
	  $this->db->order_by('namaItem', 'ASC');
	  $query = $this->db->get('inventory_item');
	  $output = '<option value="">Pilih item yang terkait dengan klasifikasi tersebut</option>
	  			 <option value="tambahJenisItemBaru" id="addNewOptionJenisItemttt">Tambah Klasifikasi Baru</option>
	  ';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->idInvItem.'">'.$row->namaItem.'</option>';
	  }
	  echo json_encode($output);
	 }

	 public function selectDetailItemModel($idInvKlasifikasi)
	 {
	  $this->db->where('idInvItem', $idInvKlasifikasi);
	  $this->db->order_by('variabel', 'ASC');
	  $query = $this->db->get('inventory_detail_item');
	  $output = "";
	  if (!$query->result()) {
	  	$output .= '<div class="col-md-12 alert alert-info">
                    
                    <span>
                      <b> Info - </b> Tidak ada detail data untuk item ini. Anda dapat menambahkan variabel baru pada kolom isian dibawah ini.</span>
                  </div>';
	  }else{
		  foreach($query->result() as $row)
		  {
		   // $output .= "<div  class='col-md-3' id='dataDetail".$row->idDetailItem."'><div class='card'><div class='card-body'><a href='".base_url()."Managements/show/dataDetail".$row->idDetailItem."' class='text-dark' >".$row->variabel."</a></div></div></div>";
		   $output .= "<div  class='col-md-3' id='dataDetail'><div class='card'><div class='card-body'>".$row->variabel."</div></div></div>";
		  }
		}
	  echo json_encode($output);
	 }

	 public function selectDetailItemModelShopPages($idInvKlasifikasi,$idTokoAktif,$randomCodeNya)
	 {
	  
	  $query = $this->Home_model->getSelectData("*, inventory_item.namaItem itemName","item_stock_actual, item_on_shop, inventory_item", "WHERE inventory_item.idInvItem=item_on_shop.idItemRequest and inventory_item.idInvItem=item_stock_actual.idInvItem and item_on_shop.statusItemOnShop='successed' and inventory_item.idInvItem=$idInvKlasifikasi and item_stock_actual.idTokoTerkait=$idTokoAktif GROUP BY item_on_shop.idItemRequest ORDER BY inventory_item.namaItem ASC");
	  $output;
	  
	  if (!$query->result()) {
	  	$output['isi'] = '<div class="col-md-12 alert alert-info">
                    
                    <span>
                      <b> Info - </b> Tidak ada detail data untuk item ini. Anda dapat menambahkan variabel baru pada kolom isian dibawah ini.</span>
                  </div>';
	  }else{
	  	 
		  foreach($query->result() as $row)
		  {
		   // $output .= "<div  class='col-md-3' id='dataDetail".$row->idDetailItem."'><div class='card'><div class='card-body'><a href='".base_url()."Managements/show/dataDetail".$row->idDetailItem."' class='text-dark' >".$row->variabel."</a></div></div></div>";
		   $output['isi'] = '

		   
		  
			   <div style="margin-bottom:10px; border-bottom:1px solid #f2f2f2; width:100%;padding:20px;padding-bottom:12px;padding-top:12px;" id="trPesanan'.$row->idInvItem.'">

			    <form action="" class="m-t-40" method="post" enctype="multipart/form-data" id="myform">
				   <table width=100% style="" id="tblPayment">
					   <tr class="trPaymentInvoice">
						   <td width=40%>'.$row->namaItem.'
						   <span style="display:block"><small><span class="badge badge-info">Stock '.$row->stockTerkini.'</span>
						   	<span class="badge badge-warning">@ Rp '.number_format($row->hargaItem,0,',','.').'</span>
						   	<input type="hidden" class="hrgItemNya" id="hrgItem'.$row->idInvItem.'" name="hrgItemInput[]" value="'.$row->hargaItem.'">
						   	</small>
						   </span>
						   </td>
						   <input type="hidden" id="idItem'.$row->idInvItem.'" name="idItemInput[]" value="'.$row->idInvItem.'">
						   <input type="hidden" id="namaItem'.$row->idInvItem.'" name="namaItemInput[]" value="'.$row->itemName.'">
						   <input type="hidden" id="idTokoTerkaitNya'.$row->idInvItem.'" name="idTokoTerkaitNyaInput[]" value="'.$row->idTokoTerkait.'" >
						   <td width=40% >
						   <div class="input-group number-spinner" style="text-align:center;">
								
									<span style="transform:scale(0.8,0.8);" class="btn btn-dark btn-just-icon" data-dir="dwn"><i class="material-icons" style="margin:auto; ">expand_more</i></span>
								
								<input type="text" id="jmlPesanan'.$row->idInvItem.'" class="form-control" min=0 style="width:25%; font-size:20px;border:none;color:#000; text-align:center" max="'.$row->stockTerkini.'" value="0" maxlength="3" name="jmlPesananInput[]">
								
									<span style=" transform:scale(0.8,0.8);" class="btn btn-dark btn-just-icon" data-dir="up"><i class="material-icons">expand_less</i></span>
								
							</div>
						   
						   
						   </td>
						   
						   <td width=20% class="tdTotal text-center">
						   <div id="totalHslPesanan'.$row->idInvItem.'" style="padding-left:10px;">0</div>
						   <input type="hidden" id="totalHrgHiddenID'.$row->idInvItem.'" class="totalprice" name="totalHrgHiddenInput[]">
						   </td>
						  
						   	
			               
						   
					   </tr>
					   <div style="position:absolute; right:-25px;">
					   <button type="submit" class="btn btn-dark btn-round btn-just-icon" style="padding:0px; transform:scale(0.8,0.8);" id="btnHapusTD'.$row->idInvItem.'">
			                  <i class="material-icons" style="padding:0px;"">delete_outline</i>
			        
			                </button>
			                </div>


				   </table>
				   
				   <script type="text/javascript">

				   	
				 

				  $(document).ready(function() {
				   	var jmlNya'.$row->idInvItem.' = 0;
					var hrgNya'.$row->idInvItem.' = 0;
				   	
				   	var hslNya'.$row->idInvItem.' = 0;
				   	var totalPayment = 0;
				   	var total = 0;
				   	
				    var value1'.$row->idInvItem.'= 0 ;
				    var rcode = "'.$randomCodeNya.'";

				   	$("#jmlPesanan'.$row->idInvItem.'").on("change", function(){
					   	  
		                  jmlNya'.$row->idInvItem.' =  $(this).val();
		                  hrgNya'.$row->idInvItem.' =  $("#hrgItem'.$row->idInvItem.'").val();
		                  hslNya'.$row->idInvItem.' = jmlNya'.$row->idInvItem.' * hrgNya'.$row->idInvItem.';
		                  //document.getElementById("totalHslPesanan'.$row->idInvItem.'").innerHTML = hslNya'.$row->idInvItem.';
		                  
		                  $("#totalHrgHiddenID'.$row->idInvItem.'").val(hslNya'.$row->idInvItem.');
		                  

						  // $("#totalHslPesanan'.$row->idInvItem.'").html(hslNya'.$row->idInvItem.'.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

						  $("#totalHslPesanan'.$row->idInvItem.'").html(hslNya'.$row->idInvItem.'.toString());
						  

						   
						   //  value1'.$row->idInvItem.' += parseInt($("#totalHrgHiddenID'.$row->idInvItem.'").val()) || 0;
			               	
										               
						   // $("#divTotalHargaNya").text(value1'.$row->idInvItem.'.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));


						  			//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
						  			
						  			total = 0;

									$(".tdTotal").each(function() {
									   			
										total += parseInt($(this).text());
									
									});
									$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));	


									if ($("#jmlPesanan'.$row->idInvItem.'").filter(function(){ return this.value.trim(); }).length) {
                                                 $("#divTombolAcceptNya").fadeIn(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
									}
                                    else {
                                                  $("#divTombolAcceptNya").fadeOut(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});

                                    }
									//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
					
				   });


				   										

												$("#btnTombolAcceptNyaID").on("click", function(evented){
													evented.preventDefault();
														

                                                 		var idTokoTerkaitNyaX = $("#idTokoTerkaitNya'.$row->idInvItem.'").val();
														var hrgItemNYa = $("#hrgItem'.$row->idInvItem.'").val();
                                                  		var idItemNya = $("#idItem'.$row->idInvItem.'").val();
                                                  		var namaItemNya = $("#namaItem'.$row->idInvItem.'").val();
                                                  		var jmlPesananNya = $("#jmlPesanan'.$row->idInvItem.'").val();
                                                  		var totalHrgHiddenIDNya = $("#totalHrgHiddenID'.$row->idInvItem.'").val();
                                                  		var codeX = $("#idTransactionTag").text();

                                                  		jQuery.ajax({
					                                              type: "POST",
					                                              url: "'.base_url().'"+"Managements/insertPaymentInvoice",
					                                              dataType: "json",
						                                          //mengirim data dengan type post
						                                          data: {codeTrans:codeX, hargaItemNya: hrgItemNYa,namaItemNyaaa : namaItemNya, idItemNyaaa : idItemNya, jumlahPesananNya : jmlPesananNya, totalHargaNya : totalHrgHiddenIDNya, idTokoTerkaitNyaXXX : idTokoTerkaitNyaX},
						                                          //menerima result dari controller
						                                          
						                                          success: function(data) {

						                                          		md.showNotificationModifyHawart("success","bottom","left","Data berhasil diinputkan ke database");
						                                          		   var resultCode ="";
						                                          		   var characters       = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
																		   var charactersLength = characters.length;
																		   for ( var i = 0; i < 10; i++ ) {
																		      resultCode += characters.charAt(Math.floor(Math.random() * charactersLength));
																		   }
																		   
						                                          		$("#idTransactionTag").text(resultCode);
						                                          }
					                                          
					                                    });

					                                    $("#trPesanan'.$row->idInvItem.'").remove();


								                  		//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
								                  			total = 0;

															$(".tdTotal").each(function() {
															   			
																total += parseInt($(this).text());
															
															});
															$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

															if (total) {
						                                                  $("#divTombolAcceptNya").fadeIn(900);
						                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
						                                                  
						                                            }
						                                            else {
						                                                  
						                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});
						                                                  $("#divTombolAcceptNya").fadeOut(900);

						                                    }

						                                //UNTUK MENGHASILKAN TOTAL----------------------------------------------------------


			                                             	

                                                  });


				   $("#btnHapusTD'.$row->idInvItem.'").on("click", function(){

		                  $("#trPesanan'.$row->idInvItem.'").remove();


		                  		//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
		                  			total = 0;

									$(".tdTotal").each(function() {
									   			
										total += parseInt($(this).text());
									
									});
									$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

									if (total) {
                                                  $("#divTombolAcceptNya").fadeIn(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
                                                  
                                            }
                                            else {
                                                  
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});
                                                  $("#divTombolAcceptNya").fadeOut(900);

                                    }

                                //UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
		   
				   });




				  





				   });


				  


			       </script>

			       </form>
			   </div>

			   
		   
		   ';
		  }

		 

		}

		


	  	echo json_encode($output);
	 }


	public function updateStockItemIfJustUpdate($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock',"$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfJustUpdateByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest',"$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopper($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini',"$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}


	public function updateStockItemIfTambahkan($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock','stock +'."$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfTambahkanByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest','stockRequest +'."$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopperIfTambah($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini +'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}


	public function updateStockItemIfKurangi($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock','stock -'."$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfKurangiByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest','stockRequest -'."$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopperIfKurang($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini -'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockSoldOutBySellerIfSent($where1,$stockNya,$where2){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini -'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockItemWhenAdd($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini +'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockItemWhenPaymentOut($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini -'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}



	 
     
}
?>