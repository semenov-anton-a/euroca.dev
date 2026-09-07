<h1>TESTs</h1>
<?php
    // dd(get_defined_vars());

?>

<h2>Get Methosts</h2>
<ul>
<?php
    foreach ($urls['get'] as $method => $url)
    {
        echo "<li><a href='{$url}'>{$method}</a></li>";
    }
?>
</ul>
</br>
<h2>Post Methosts Heandles</h2>
<ul>
<?php
    foreach ($urls['post'] as $method => $url)
    {
        echo "<li>{$method}</li>";
    }
?>
</ul>

</hr>
<h1>Data</h1>
<pre>
<?php
    // print_r(?$dataVars);
?>
</pre>



