foreach ($Attribute_set_by_id as $v) {

                                     $a_set_value = unserialize($v->value);

                                     foreach ($a_set_value  as $key => $Attribute_id) {
                                        

                                         echo Helper::attribute_by_id($Attribute_id)->name;
                                        foreach ($Attribute as $v) {

                                            if ($v->id == $Attribute_id) { ?>
                                        <div class="control-group" >
                                            <label class="control-label" for="selectError3"><?php echo $v->name; ?></label>
                                            <div class="controls">
                                                <select data-placeholder="None" multiple class="chosen-select" tabindex="8" 
                                                name="<?php echo $v->id; ?>[]">
                                                <option value="">No Color</option>
                                                <?php  
                                                        $attribute_values = unserialize($v->value);
                                                        for($i = 0 ; $i < count($attribute_values) ; $i++){
                                                        echo '<option value="'.$i.'">'.$attribute_values[$i].'</option>';
                                                        }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                               
                         <?php                       
                                            }
                                        }
                                        break;
                                    }
                                }

                            ?>