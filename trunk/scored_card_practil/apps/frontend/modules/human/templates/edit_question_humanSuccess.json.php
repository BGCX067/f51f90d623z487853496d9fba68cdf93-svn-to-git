<?php
echo  json_encode(array(
                   "success" =>  true,
                   "question" =>  $pregunta,
                   "questionComplete" =>  $preguntaBean->getQuestion()
   ));
?>