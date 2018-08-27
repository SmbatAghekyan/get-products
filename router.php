<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);
        if ($url == "/")
        {
            $request->controller = "getproducts";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);

            $explode_url = array_slice($explode_url, 1);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
            // echo"<pre>"; print_r($request); echo "</pre>"; exit;
        }

    }
}
?>