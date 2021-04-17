<?php
/**
 * Created by PhpStorm.
 * User: cengizakcan
 * Date: 23.02.2020
 * Time: 19:55
 */

namespace App\Main\Model;


class nestable {

    /**
     * @param $getSqlTable
     * @return array
     */
    public static function sqlConverter($getSqlTable){

        $ref   = [];
        $items = [];


        foreach($getSqlTable as $data) {

            $thisRef = &$ref[$data["uuid"]];

            $thisRef['parent']  = $data["parent"];
            $thisRef['label']   = $data["label"];
            $thisRef['link']    = $data["link"];
            $thisRef['uuid']      = $data["uuid"];
            $thisRef['cover']      = $data["cover"];

            if($data["parent"] == 0) {
                $items[$data["uuid"]] = &$thisRef;
            } else {
                $ref[$data["parent"]]['child'][$data["uuid"]] = &$thisRef;
            }

        }

        return  $items;

    }

    /**
     * @param $items
     * @param string $class
     * @return string
     */
    public static function buildMenu($items, $class = 'dd-list') {

        $html = "<ol class=\"".$class."\" id=\"menu-uuid\">";

        foreach($items as $key => $value) {

            $html.= '<li class="dd-item" data-uuid="'.$value['uuid'].'" >
                    <div class="dd-handle">
                            <span>'.$value['label'].'</span>
                            <a style="position: absolute; right: 50px; cursor: pointer;" class="delete-button-nestable" data-uuid="'.$value['uuid'].'" data-label="'.$value['label'].'" data-link="'.$value['link'].'"  ><i class="fas fa-trash"></i></a>
                            <a style="position: absolute; right: 20px; cursor: pointer;" class="edit-button-nestable" data-uuid="'.$value['uuid'].'" data-label="'.$value['label'].'" data-link="'.$value['link'].'"  data-cover="'.$value['cover'].'" ><i class="fas fa-pencil-alt"></i></a>
                    </div>';

            if(isset($value['child']))
                $html .= self::buildMenu($value['child'],'dd-list');

            $html .= "</li>";
        }

        $html .= "</ol>";

        return $html;

    }


    /**
     * @param $items
     * @param string $class
     * @return string
     */
    public static function buildMenuSelect($items, $class = 'up') {

        $html = "";

        foreach($items as $key=>$value) {

            if($class === "up"){
                $html .= "<option data-uuid='{$value['uuid']}' data-link='{$value['link']}' data-parent='{$value['parent']}' >{$value['label']}</option>";
            }

            if($class === "down"){
                $html .= "<option data-uuid='{$value['uuid']}' data-link='{$value['link']}' data-parent='{$value['parent']}' > ".str_repeat("->",$key)." {$value['label']}</option>";
            }

            if(isset($value['child'])) {
                $html .= self::buildMenuSelect($value['child'],'down');
            }

        }

        return $html;

    }


    /**
     * @param $jsonArray
     * @param int $parentID
     * @return array
     */
    public static function parseJsonArray($jsonArray, $parentID = 0) {

        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = self::parseJsonArray($subArray->children, $subArray->uuid);
            }

            $return[] = array('uuid' => $subArray->uuid, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

    /**
     * @param $data
     * @param callable $func
     */
    public static function save($data, callable $func){

        $sort=0;
        foreach(self::parseJsonArray($data) as $row){
            $sort++;
            $func($row['uuid'],$row['parentID'],$sort);
        }

    }



}