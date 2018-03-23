<?php

namespace App\Swep\ViewHelpers;



class HtmlHelper{



    public static function modal($id, $header, $message, $close_route){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			      <div class="modal-dialog">
			        <div class="modal-content">
			          <div class="modal-header">
			            <a href="'. $close_route .'" type="button" class="close">
			              <span aria-hidden="true">&times;</span>
			            </a>
			            <h4 class="modal-title">'. $header .'</h4>

			          </div>
			          <div class="modal-body">
			            <p style="font-size: 17px;">'. $message .'</p>
			          </div>
			          <div class="modal-footer">
			            <a href="'. $close_route .'" class="btn btn-default">Close</a>
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