<?php
  $home_features = base64_encode(json_encode([0,0,0,0,1,1,2,1,4,0,0,0,0,0,0,0,0,1]));
  $result = exec("/Library/Frameworks/Python.framework/Versions/3.9/bin/python3 ml.py ".$home_features);
  echo $result; 

?>