<?php
if($data)
{
    foreach($data as $producto)
    {
        echo "Producto ID: ".$producto["id"];
        echo "<br />";
        echo "Cantidad: ".$producto["cantidad"];
        echo "<br />";
        echo "Precio: ".$producto["precio"];
        echo "<br />";
        echo "Descripcion: ".$producto["descripcion"];
        echo "<br />";
    }    
}