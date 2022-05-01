<?php
 

if (!function_exists("get_subcategory_by_id")) {

    function get_subcategory_by_id($id) {
        $CI_inst = &get_instance();
        $CI_inst->load->model(array("businesscategorylist_db", "businesscategorylist_includes_db"));
        return $CI_inst->businesscategorylist_includes_db->get_subcategory_by_id($id);
    }

}


if (!function_exists("all_subcategories")) {
    
    function all_subcategories() {
        $CI_inst = &get_instance();
        $CI_inst->load->model(array("businesscategorylist_db", "businesscategorylist_includes_db"));
        return $CI_inst->businesscategorylist_includes_db->get_all_subcategories();
    }
    
}
