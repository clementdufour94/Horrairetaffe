<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
    <form action="" method="post">
        <label>Salaire:</label>
        <input type="number" step=any name="type"></input>
        <label>Arrivé:</label>
        <input type="time" name="arrive"></input>
        <label>Fin:</label>
        <input type="time" name="fin"></input>
        <button>rechercher</button>
    </form>
    
</body>
</html>
<?php
if (isset($_POST['type'])){
    $salaire = $_POST['type'];
    
    $heure_arrive =$_POST['arrive'];
    $heure_fin =$_POST['fin'];
    
   

    $start=$_POST['arrive'];
    $end_22 = "22:00";
    $end_06 = "06:00";
    $h00 = "00:00";
    $end = $_POST['fin'];

    

    if ($start< $end_22){
        $heure_de_jour_avant_22h00 = (strtotime($end_22) - strtotime($start)) / 60;
        
        
         //en minute de l'heure d'arrivée jusqu'a 22h00 (donc temps normal)
        if ($end< $end_06){

            
            $heure_de_nuit = ((strtotime($end)- strtotime($h00)) / 60)+120;
            
             //en minute l'heure de 22h00 à la fin à 150%
            
            


        }elseif($end>=$end_06){
            $heure_de_nuit = (((strtotime($end_06)- strtotime($h00)) / 60)+120);
            $heure_de_jour_après_6h00 = ((strtotime($end)- strtotime($end_06)) / 60);

            //Sinon l'heure en minute de 22h00 jusqu'a 6h00 à 150%
           

        }
        if(isset($heure_de_jour_après_6h00)){
            $heure_totale_de_jour = $heure_de_jour_avant_22h00 + $heure_de_jour_après_6h00;
           

        }else{
            $heure_totale_de_jour = $heure_de_jour_avant_22h00 ;

        }
        echo ("Heure total de jour : ");
        echo  ($heure_totale_de_jour)/60;
        ?> <br> <?php 
        echo ("Heure total de nuit : ");
        echo  ($heure_de_nuit)/60 ;
        ?> <br> <?php
        echo ("Salaire total du jour : ");
        echo  ((($heure_totale_de_jour)/60) * $salaire) ;
        echo ("€");
        ?> <br> <?php 
        echo ("Salaire total de la nuit : ");
        echo  (($heure_de_nuit)/60)*1.5* $salaire ;
        echo ("€");
        ?> <br> <?php
        echo ("Salaire total : ");
        echo (((($heure_totale_de_jour)/60) * $salaire)+((($heure_de_nuit)/60)*1.5* $salaire));
        echo ("€");

        
    
    }
    elseif($start>=$end_22){
        if ($end< $end_06){


            $heure_de_nuit = ((strtotime($end)- strtotime($h00)) / 60)+ (( strtotime("24:00") - strtotime($start) ) / 60); // Là que ca bloque car on rajout 2h00 pour allé jusqu'à 22 sauf que commence après 
            
             //en minute l'heure de 22h00 à la fin à 150%
            
        
        }elseif($end>=$end_06){
            $heure_de_nuit = (((strtotime($end_06)- strtotime($h00)) / 60)+(( strtotime("24:00") - strtotime($start) ) / 60));
            $heure_de_jour_après_6h00 = ((strtotime($end)- strtotime($end_06)) / 60);

            //Sinon l'heure en minute de 22h00 jusqu'a 6h00 à 150%
            //Et l'heure en minute après 6h00
          

        }
        $heure_totale_de_jour=0;
        if(isset($heure_de_jour_après_6h00)){
            $heure_totale_de_jour =  $heure_de_jour_après_6h00;
         
        }
        
        if(isset($heure_totale_de_jour)){
            echo ("Heure total de jour :");
        echo  ($heure_totale_de_jour)/60 ;
        ?> <br> <?php 
        echo ("Salaire total du jour : ");
        echo  (($heure_totale_de_jour)/60) * $salaire ;
        echo ("€");
        ?> <br> <?php 

        }
        
        echo ("Heure total de nuit :");
        echo  ($heure_de_nuit)/60 ;
        ?> <br> <?php 
        echo ("Salaire total de la nuit : ");
        echo  (($heure_de_nuit)/60)*1.5* $salaire ;
        echo ("€");
        ?> <br> <?php
        echo ("Salaire total : ");
        echo (((($heure_totale_de_jour)/60) * $salaire)+((($heure_de_nuit)/60)*1.5* $salaire));
        echo ("€");


    }

    
   
    

   
   
  
    

} 
