<?php //print_r(unserialize($edit_data->attribute));

foreach (unserialize($edit_data->attribute) as $key => $value) {
    //print_r($value);
    foreach ($value as $key2 => $value2) {
        if($key2 == 'attrute_id'){
            //print_r($value2);
            echo $value2;
        }
        if($key2 == 'value'){
            //print_r($value2);
            foreach ($value2 as $value) {?>
            <select data-placeholder="None" multiple class="chosen-select" tabindex="8" 
                    name="<?php echo $v->id; ?>[]">
                    <option value="">No Color</option>
                    <?php  
                            $attribute_values = unserialize($v->value2);
                            for($i = 0 ; $i < count($attribute_values) ; $i++){
                                if($i == $value){
                                echo '<option value="'.$i.'" select>'.'hello'.'</option>';
                                }else{
                                   echo '<option value="'.$i.'">'.'dur'.'</option>'; 
                                }
                            }
                    ?>
            </select>
            <?php    //echo $value;
            }
        }
    }
    break;
}

