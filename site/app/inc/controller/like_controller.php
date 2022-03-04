<?php
class like_controller
{
    public static function data4select($key = "idx", $filters = array(), $field = "idx")
    {
        $boiler = new like_model();
        $boiler->set_field(array($key, $field));
        $boiler->set_filter($filters);
        $boiler->load_data();
        $out = array();
        foreach ($boiler->data as $value) {
            $out[$value[$key]] = $value[$field];
        }
        return $out;
    }

    /**
     * Like Forum Response
     *
     */
    public static function likeresponse($info)
    {
        if (!site_controller::check_login()) {
            basic_redir($GLOBALS["home_url"]);
        }

        $info["idx"] = (int)current(like_controller::data4select("idx", array(" object_id = '" . $info["post"]["object_id"] . "' ", " user_id = '" . $info["post"]["user_id"] . "'")));

        $like = new like_model();

        if (isset($info["post"]["object_id"]) && isset($info["post"]["user_id"]) && (int)$info["idx"] != 0) {
            $like->set_filter(array(" idx = '" . $info["idx"] . "'"));
            $like->load_data();
            $data = current($like->data);
            if ($data["is_liked"] == "yes") {
                $info["post"]["is_liked"] = "no";
                $like->populate($info["post"]);
                $like->save();
            } else {
                $info["post"]["is_liked"] = "yes";
                $like->populate($info["post"]);
                $like->save();
            }
        } else {
            $like->populate($info["post"]);
            $like->save();
        }

        $like->set_filter(array(" object_id = '" .  $info["post"]["object_id"] . "' ", " is_liked = 'yes' "));
        $like->load_data();
        $data = $like->data ;

        $qtdLikes = count($data);

        echo json_encode($qtdLikes);
    }
}
