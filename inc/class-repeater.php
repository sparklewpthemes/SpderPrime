<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class spiderprime_Image_Radio_Control extends WP_Customize_Control {
    public function render_content() {
    if ( empty( $this->choices ) ){
        return;
    }
        $name = '_customize-radio-' . $this->id;
    ?>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <ul class="controls" id = 'spiderprime-img-container'>
        <?php
            foreach ( $this->choices as $value => $label ) :
                $class = ($this->value() == $value)?'spiderprime-radio-img-selected spiderprime-radio-img-img':'spiderprime-radio-img-img';
                ?>
                <li style="display: inline;">
                    <label>
                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                        <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
                    </label>
                </li>
        <?php endforeach; ?>
    </ul>
    <?php } 
}

class SpiderPrime_General_Repeater extends WP_Customize_Control {
        private $options = array();
        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            $this->options = $args;
        }
        public function render_content() {
            $this_default = json_decode($this->setting->default);
            $values = $this->value();
            $json = json_decode($values);
            if(!is_array($json)) $json = array($values);
            $it = 0;
            $it2 = 0;

            $options = $this->options;
            
            if(!empty($options['homepage_section_page'])){
                $homepage_section_page = $options['homepage_section_page'];
                    $spiderprime_pages = get_pages();
                    $sp_pages = array();
                    $sp_pages[] = 'Select Section Page';
                    foreach ( $spiderprime_pages as $sp_page ) {
                       $sp_pages[$sp_page->post_title] = $sp_page->post_title;     
                    }
                $section_pages = $sp_pages;
            } else {
                 $homepage_section_page = false;
            }

            if(!empty($options['homepage_section_layout'])){
                $homepage_section_layout = $options['homepage_section_layout'];
                $section_layout = array( 'Default Section','Features Section','Portfolio Section','Call to Action Section','Blog Section','Our Team Section','Testimonial Section');
            } else {
                 $homepage_section_layout = false;
            }

            if(!empty($options['homepage_section_category'])){
                $homepage_section_category = $options['homepage_section_category'];
                    $spiderprime_categorys = get_categories();
                    $sp_categorys = array();
                    $sp_categorys[] = 'Select Section Category';
                    foreach ( $spiderprime_categorys as $sp_category ) {
                       $sp_categorys[$sp_category->slug] = $sp_category->name; 
                    }
                $section_categorys = $sp_categorys;
            } else {
                 $homepage_section_category = false;
            }

            if(!empty($options['homepage_bg_image'])){
                $homepage_bg_image = $options['homepage_bg_image'];
            } else {
                $homepage_bg_image = false;
            }

            if(!empty($options['homepage_button_title'])){
                $homepage_button_title = $options['homepage_button_title'];
            } else {
                $homepage_button_title = false;
            }

            if(!empty($options['homepage_button_textarea'])){
                $homepage_button_textarea = $options['homepage_button_textarea'];
            } else {
                $homepage_button_textarea = false;
            }

            if(!empty($options['homepage_button_text'])){
                $homepage_button_text = $options['homepage_button_text'];
            } else {
                $homepage_button_text = false;
            }            

            if(!empty($options['homepage_button_link'])){
                $homepage_button_link = $options['homepage_button_link'];
            } else {
                $homepage_button_link = false;
            }
 ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="spiderprime_general_control_repeater spiderprime_general_control_droppable">
                <?php
                    if(empty($json)) {                        
                ?>
                        <div class="spiderprime_general_control_repeater_container">
                            <div class="spiderprime-customize-control-title"><?php esc_html_e('SpiderPrime HomePage Section','spiderprime')?></div>
                            <div class="spiderprime-box-content-hidden">
                                
                                <?php
                                    if($homepage_section_page == true){
                                ?>
                                    <span class="customize-control-title"><?php esc_html_e('Select Section Page','spiderprime')?></span>
                                    <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_page">
                                        <?php
                                            foreach($section_pages as $section_page) {
                                                echo '<option value="'.esc_attr($section_page).'">'.esc_attr($section_page).'</option>';
                                            }
                                        ?>
                                    </select>
                                <?php
                                    }

                                    if($homepage_section_layout == true){
                                ?>
                                    <span class="customize-control-title"><?php esc_html_e('Select Section Layout','spiderprime')?></span>
                                    <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_layout">
                                        <?php
                                            foreach($section_layout as $section) {
                                                echo '<option value="'.esc_attr($section).'">'.esc_attr($section).'</option>';
                                            }
                                        ?>
                                    </select>
                                <?php
                                    } 

                                    if($homepage_section_category == true){
                                ?>
                                    <span class="customize-control-title"><?php esc_html_e('Select Section Category','spiderprime')?></span>
                                    <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_category">
                                        <?php
                                            foreach($section_categorys as $section_category) {
                                                echo '<option value="'.esc_attr($section_category).'">'.esc_attr($section_categorys).'</option>';
                                            }
                                        ?>
                                    </select>
                                <?php
                                    }

                                    if($homepage_bg_image ==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Section Background Image','spiderprime')?></span>
                                        <p class="spiderprime_image_control">
                                            <input type="text" class="widefat section_bg_media_url">
                                            <input type="button" class="button button-primary custom_media_button_spiderprime" value="<?php esc_html_e('Upload Image','spiderprime'); ?>" />
                                        </p>
                                <?php
                                    }

                                    if($homepage_button_title==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Enter Title Text','spiderprime')?></span>     
                                        <input type="text" class="spiderprime_title" placeholder="<?php esc_html_e('Enter Title Text','spiderprime'); ?>"/>
                                <?php
                                    }

                                    if($homepage_button_textarea==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Enter Short Text','spiderprime')?></span>     
                                        <textarea class="spiderprime_short_textarea" placeholder="<?php esc_html_e('Enter Short Text','spiderprime'); ?>"></textarea>
                                <?php
                                    }

                                    if($homepage_button_text==true){
                                ?>
                                        <span class="customize-control-title"><?php esc_html_e('Enter View More Button Text','spiderprime')?></span>
                                        <input type="text" class="spiderprime_view_more_button_text" placeholder="<?php esc_html_e('Enter View More Text','spiderprime'); ?>"/>
                                <?php
                                    }                                    

                                    if($homepage_button_link==true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Enter View More Button Link','spiderprime')?></span>
                                        <input type="text" class="spiderprime_view_more_button_link" placeholder="<?php esc_html_e('Enter View More Text','spiderprime'); ?>"/>
                                <?php }

                                ?>
                                <input type="hidden" class="spiderprime_box_id">
                            <button type="button" class="spiderprime_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete Section Area','spiderprime'); ?></button>
                            </div>
                        </div>
                <?php
                    } else {

                        if ( !empty($this_default) && empty($json)) {
                            foreach($this_default as $icon){                             
                ?>
                                <div class="spiderprime_general_control_repeater_container spiderprime_draggable">
                                    <div class="spiderprime-customize-control-title"><?php esc_html_e('HomePage Section Area','spiderprime')?></div>
                                    <div class="spiderprime-box-content-hidden">
                                        
                                        <?php
                                            if($homepage_section_page == true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Select Section Page','spiderprime')?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_page">
                                                <?php
                                                    foreach($section_pages as $section_page) {
                                                        echo '<option value="'.esc_attr($section_page).'" '.selected($icon->section_value_pge,$section_page).'">'.esc_attr($section_page).'</option>';
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                            }

                                             if($homepage_section_layout == true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Select Section Layout','spiderprime')?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_layout">
                                                <?php
                                                    foreach($section_layout as $section) {
                                                        echo '<option value="'.esc_attr($section).'" '.selected($icon->section_value,$section).'">'.esc_attr($section).'</option>';
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                            }

                                            if($homepage_section_category == true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Select Section Category','spiderprime')?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_category">
                                                <?php
                                                    foreach($section_categorys as $section_category) {
                                                        echo '<option value="'.esc_attr($section_category).'" '.selected($icon->section_value_cat,$section_category).'">'.esc_attr($section_category).'</option>';
                                                    }
                                                ?>
                                            </select>
                                        <?php
                                            }

                                                if($homepage_bg_image==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Section Background Image','spiderprime')?></span>
                                                    <p class="spiderprime_image_control">
                                                        <input type="text" class="widefat section_bg_media_url" value="<?php if(!empty($icon->bg_image_url)) {echo esc_attr($icon->bg_image_url);} ?>">
                                                        <input type="button" class="button button-primary custom_media_button_spiderprime" value="<?php esc_html_e('Upload Image','spiderprime'); ?>" />
                                                    </p>
                                        <?php   }

                                                if($homepage_button_title ==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Enter Title Text','spiderprime')?></span>     
                                                    <input type="text" value="<?php if(!empty($icon->title_text)) echo esc_attr($icon->title_text); ?>" class="spiderprime_title" placeholder="<?php esc_html_e('Enter Title Text','spiderprime'); ?>"/>
                                        <?php
                                                }

                                                if($homepage_button_textarea ==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Enter Short Text','spiderprime')?></span>     
                                                    <textarea class="spiderprime_short_textarea" placeholder="<?php esc_html_e('Enter Short Text','spiderprime'); ?>"><?php if(!empty($icon->short_textarea)) {echo esc_attr($icon->short_textarea);} ?></textarea>
                                        <?php
                                                }

                                                if($homepage_button_text==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Enter View More Button Text','spiderprime')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->view_more_text)) echo esc_attr($icon->view_more_text); ?>" class="spiderprime_view_more_button_text" placeholder="<?php esc_html_e('Enter View More Text','spiderprime'); ?>"/>
                                        <?php
                                                }                                                

                                                if($homepage_button_link){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Enter View More Button Link','spiderprime')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->view_more_link)) echo esc_url($icon->view_more_link); ?>" class="spiderprime_view_more_button_link" placeholder="<?php esc_html_e('Enter View More Link','spiderprime'); ?>"/>
                                        <?php   }
                                        ?>
                                        <input type="hidden" class="spiderprime_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                    <button type="button" class="spiderprime_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete Section Area','spiderprime'); ?></button>
                                    </div>

                                </div>

                <?php
                                $it++;
                            }
                        } else {
                            foreach($json as $icon){
                    ?>
                                <div class="spiderprime_general_control_repeater_container spiderprime_draggable">
                                    <div class="spiderprime-customize-control-title"><?php esc_html_e('HomePage Section Area','spiderprime')?></div>
                                    <div class="spiderprime-box-content-hidden">
                                    <?php
                                         if($homepage_section_page == true){
                                    ?>
                                        <span class="customize-control-title"><?php esc_html_e('Select Section Page','spiderprime')?></span>
                                        <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_page">
                                            <?php
                                                foreach($section_pages as $section_page) {
                                                    echo '<option value="'.esc_attr($section_page).'" '.selected($icon->section_value_page, $section_page).'">'.esc_attr($section_page).'</option>';
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }

                                        if($homepage_section_layout == true){
                                    ?>
                                        <span class="customize-control-title"><?php esc_html_e('Select Section Layout','spiderprime')?></span>
                                        <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_layout">
                                            <?php
                                                foreach($section_layout as $section) {
                                                    echo '<option value="'.esc_attr($section).'" '.selected($icon->section_value,$section).'">'.esc_attr($section).'</option>';
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }

                                        if($homepage_section_category == true){
                                    ?>
                                        <span class="customize-control-title"><?php esc_html_e('Select Section Category','spiderprime')?></span>
                                        <select name="<?php echo esc_attr($this->id); ?>" class="spiderprime_homepage_section_category">
                                            <?php
                                                foreach($section_categorys as $section_category) {
                                                    echo '<option value="'.esc_attr($section_category).'" '.selected($icon->section_value_cat,$section_category).'">'.esc_attr($section_category).'</option>';
                                                }
                                            ?>
                                        </select>
                                    <?php
                                        }

                                        if($homepage_bg_image == true){ ?>
                                            <span class="customize-control-title"><?php esc_html_e('Section Background Image','spiderprime')?></span>
                                            <p class="spiderprime_image_control">
                                                <input type="text" class="widefat section_bg_media_url" value="<?php if(!empty($icon->bg_image_url)) {echo esc_attr($icon->bg_image_url);} ?>">
                                                <input type="button" class="button button-primary custom_media_button_spiderprime" value="<?php esc_html_e('Upload Image','spiderprime'); ?>" />
                                            </p>
                                    <?php }

                                            if($homepage_button_title ==true){
                                        ?>
                                                <span class="customize-control-title"><?php esc_html_e('Enter Title Text','spiderprime')?></span>     
                                                <input type="text" value="<?php if(!empty($icon->title_text)) echo esc_attr($icon->title_text); ?>" class="spiderprime_title" placeholder="<?php esc_html_e('Enter Title Text','spiderprime'); ?>"/>
                                    <?php
                                            }

                                            if($homepage_button_textarea ==true){
                                    ?>
                                                <span class="customize-control-title"><?php esc_html_e('Enter Short Text','spiderprime')?></span>  
                                                <textarea class="spiderprime_short_textarea" placeholder="<?php esc_html_e('Enter Short Text','spiderprime'); ?>"><?php if(!empty($icon->short_textarea)) {echo esc_attr($icon->short_textarea);} ?></textarea>
                                    <?php
                                            }

                                            if($homepage_button_text==true){
                                        ?>
                                                <span class="customize-control-title"><?php esc_html_e('Enter View More Button Text','spiderprime')?></span>
                                                <input type="text" value="<?php if(!empty($icon->view_more_text)) echo esc_attr($icon->view_more_text); ?>" class="spiderprime_view_more_button_text" placeholder="<?php esc_html_e('Enter View More Text','spiderprime'); ?>"/>
                                    <?php
                                            }                                       

                                            if($homepage_button_link){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Enter View More Button Link','spiderprime')?></span>
                                                <input type="text" value="<?php if(!empty($icon->view_more_link)) echo esc_url($icon->view_more_link); ?>" class="spiderprime_view_more_button_link" placeholder="<?php esc_html_e('Enter View More Link','spiderprime'); ?>"/>
                                    <?php   }
                                        ?>
                                        <input type="hidden" class="spiderprime_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                        <button type="button" class="spiderprime_general_control_remove_field button" <?php 
                                            if ($it == 0)
                                            echo 'style="display:none;"'; ?>><?php esc_html_e('Delete Section Area','spiderprime'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;
                                
                            }
                        }
                    }

                if ( !empty($this_default) && empty($json)) {
                     
                ?>
                    <input type="hidden" id="spiderprime_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="spiderprime_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
            <?php } else {  ?>
                    <input type="hidden" id="spiderprime_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="spiderprime_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
            <?php } ?>
            </div>
            <button type="button"   class="button add_field spiderprime_general_control_new_field">
            <?php esc_html_e('Add New Section Area','spiderprime'); ?></button>
        <?php

    }

}