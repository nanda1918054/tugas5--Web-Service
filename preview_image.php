<?php

  //fungsi ini digunakan untuk mengambil gambar dari link yang didapatkan
  
  function getSiteOG( $url, $specificTags=0 ){
  
      $doc = new DOMDocument();
  
      @$doc->loadHTML(file_get_contents($url));
  
      $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;
  
      foreach ($doc->getElementsByTagName('meta') as $m){
          $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
          if(in_array($tag,['description','keywords']) || strpos($tag,'og:')===0) $res[str_replace('og:','',$tag)] = $m->getAttribute('content');
      }
  
  
      // jika $res di var_dump maka akan menampilkan semua attribute seperti image, title, dan deskripsi
      // tapi karena kita hanya butuh image maka kita tampilkan hanya $res['image']
  
      echo $specificTags ? array_intersect_key( $res, array_flip($specificTags) ) : $res['image'];
  
  }
  
  ?>