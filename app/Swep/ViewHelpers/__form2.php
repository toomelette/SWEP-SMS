<?php


namespace App\Swep\ViewHelpers;


use App\Swep\Helpers\__sanitize;
use Illuminate\Support\Carbon;

class __form2
{

    public static function textbox($name,$options = [],$value = null){
        $n = new __form2;
        $n->set($options);

        if(is_object($value)){
            $value = $value->$name;
        }

        return '<div class="form-group col-md-'.$n->cols.' '.$name.'">
                <label for="'. $name .'">'.$n->label.'</label> 
                <input class="form-control '.$n->class.'" id="'.$n->id.'" name="'. $name .'" type="'.$n->type.'" value="'.$value.'" placeholder="'. $n->placeholder.'" '. $n->extra_attr .' autocomplete="'.$n->autocomplete.'">
              </div>';
    }


    public static function select($name,$options = [],$value = null){
        $n = new __form2;
        $n->set($options);
        if(is_object($value)){
            $value = $value->$name;
        }
        if ($options['options'] == 'year'){
            $options['options'] = self::yearsArray();
            if($value == ''){
                $value = Carbon::now()->format('Y');
            }
        }

        $opt_html = '';
        if(isset($options['options'])){
            if(is_array($options['options'])){
                foreach ($options['options'] as $key => $option){
                    if(is_array($option)){
                        $opt_html = $opt_html.'<optgroup label="'.$key.'">';
                        foreach ($option as $key2 => $option2){
                            $sel = '';
                            if($value == $key2){
                                $sel = 'selected';
                            }
                            $opt_html = $opt_html.'<option value="'.$key2.' " '.$sel.'>'.$option2.'</option>';
                        }
                    }else{
                        $sel = '';
                        if($value == $key){
                            $sel = 'selected';
                        }
                        $opt_html = $opt_html.'<option value="'.$key.' " '.$sel.'>'.$option.'</option>';
                    }
                }
            }
        }

        return '<div class="form-group col-md-'.$n->cols .' '.$name.'">
                  <label for="'. $name .'">'. $n->label .'</label>
                  <select name="'. $name .'" id="'. $name .'" class="form-control" '. $n->extra_attr .'>
                    <option value="">Select</option>
                    '.$opt_html.'
                  </select>
                </div>';
    }

    private static function yearsArray(){
        $years = [];
        $now_year = Carbon::now()->format('Y');
        for ( $x = $now_year - 8 ; $x <= $now_year + 10; $x++){
            $years[$x] = $x;
        }
        return $years;
    }
    public static function textarea($name, $options = [],$value = null){
        if(is_object($value)){
            $value = $value->$name;
        }


        $n = new __form2;
        $n->set($options);
        return '<div class="form-group col-md-'. $n->cols .' '. $name .'">
                <label for="'. $name .'">'. $n->label .'</label>
                <textarea class="form-control '.$n->class.'" id="'.$n->id.'" name="'. $name .'" rows="'.$n->rows.'" '. $n->extra_attr .'>'. __sanitize::html_encode($value) .'</textarea>
              </div>';
    }


    public function set($array){
        if(!isset($array['class'])){
            $array['class'] = '';
        }
        if(!isset($array['cols'])){
            $array['cols'] = '';
        }
        if(!isset($array['label'])){
            $array['label'] = '';
        }
        if(isset($array['placeholder'])){
            $array['placeholder'] = $array['placeholder'];
        }else{
            $array['placeholder'] =  str_replace(':','',$array['label']);
            $array['placeholder'] = str_replace('*','',$array['placeholder']);
        }
        if(!isset($array['id'])){
            $array['id'] = '';
        } if(!isset($array['type'])){
            $array['type'] = '';
        } if(!isset($array['value'])){
            $array['value'] = '';
        } if(!isset($array['placeholder'])){
            $array['placeholder'] = '';
        }
        if(!isset($array['extra_attr'])){
            $array['extra_attr'] = '';
        }
        if(!isset($array['rows'])){
            $array['rows'] = '';
        }
        if(!isset($array['autocomplete'])){
            $array['autocomplete'] = '';
        }

        if($array['type'] == ''){
            $array['type'] = 'text';
        }

        $this->class = $array['class'];
        $this->cols = $array['cols'];
        $this->label = $array['label'];
        $this->id = $array['id'];
        $this->type = $array['type'];
        $this->value = $array['value'];
        $this->extra_attr = $array['extra_attr'];
        $this->placeholder = $array['placeholder'];
        $this->rows = $array['rows'];
        $this->autocomplete = $array['autocomplete'];
    }
    public function get($array){
        return $this->name.' Hello';
    }
}