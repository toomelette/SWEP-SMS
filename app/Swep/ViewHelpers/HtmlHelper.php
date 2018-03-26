<?php

namespace App\Swep\ViewHelpers;



class HtmlHelper{



    public static function modal($id, $header, $message){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			      <div class="modal-dialog">
			        <div class="modal-content">
			          <div class="modal-header">
			            <button class="close" data-dismiss="modal">
			              <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">'. $header .'</h4>

			          </div>
			          <div class="modal-body">
			            <p style="font-size: 17px;">'. $message .'</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			          </div>
			        </div>
			      </div>
			    </div>';
			    
    }




    public static function alert($type, $header, $message){

       return '<div class="alert alert-'. $type .' alert-dismissible">
	              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	              <h4>'. $header .'</h4>
	              '. $message .'
	            </div>';

    }
    




}