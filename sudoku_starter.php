<?php

/**
 * Charge un fichier en fournissant son chemin
 * @param string $filepath Chemin du fichier
 * @return array|null Un tableau si le fichier existe et est valide, null sinon
 */
function loadFromFile(string $filepath): ?array {
    $contenuFichierJson = file_get_contents($filepath);
    if ($contenuFichierJson === false) {
        return null;
    }

    $array = json_decode($contenuFichierJson, true);
    if ($array === null) {
        return null;
    }
    return $array; // print array
}

/**
 * Retourne la valeur d'une cellule
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @return int Valeur
 */
function get(array $grid, int $rowIndex, int $columnIndex): int {
    return $grid[$rowIndex][$columnIndex];
}

/**
 * Affecte une valeur dans une cellule
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @param int $value Valeur
 */
function set(array &$grid, int $rowIndex, int $columnIndex, int $value): void {
    $grid[$rowIndex][$columnIndex] = $value;
}

/**
 * Retourne les données d'une ligne à partir de son index
 * @param int $rowIndex Index de ligne (entre 0 et 8)
 * @return array Chiffres de la ligne demandée
 */
function row(array $grid, int $rowIndex): array {
    foreach ($grid[$rowIndex] as $case){
        $returnRow[] =  $case;
    }
    return $returnRow;
}

/**
 * Retourne les données d'une colonne à partir de son index
 * @param int $columnIndex Index de colonne (entre 0 et 8)
 * @return array Chiffres de la colonne demandée
 */
function column(array $grid, int $columnIndex): array {
    //
    foreach ($grid as $ligne){
        $returnColumn[] =  $ligne[$columnIndex];
    }
    return $returnColumn;
}

/**
 * Retourne les données d'un bloc à partir de son index
 * L'indexation des blocs est faite de gauche à droite puis de haut en bas
 * @param int $squareIndex Index de bloc (entre 0 et 8)
 * @return array Chiffres du bloc demandé
 */
function square(array $grid, int $squareIndex): array {
    //
    switch($squareIndex){
        case 0:
            for ($ligne = 0;$ligne < 3; $ligne++) {
                for ($colonne = 0;$colonne < 3; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 1:
            for ($ligne = 0;$ligne < 3; $ligne++) {
                for ($colonne = 3;$colonne < 6; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 2:
            for ($ligne = 0;$ligne < 3; $ligne++) {
                for ($colonne = 6;$colonne < 9; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 3:
            for ($ligne = 3;$ligne < 6; $ligne++) {
                for ($colonne = 0;$colonne < 3; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 4:
            for ($ligne = 3;$ligne < 6; $ligne++) {
                for ($colonne = 3;$colonne < 6; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 5:
            for ($ligne = 3;$ligne < 6; $ligne++) {
                for ($colonne = 6;$colonne < 9; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 6:
            for ($ligne = 6;$ligne < 9; $ligne++) {
                for ($colonne = 0;$colonne < 3; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 7:
            for ($ligne = 6;$ligne < 9; $ligne++) {
                for ($colonne = 3;$colonne < 6; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        case 8:
            for ($ligne = 6;$ligne < 9; $ligne++) {
                for ($colonne = 6;$colonne < 9; $colonne++) {
                    $returnSquare[] =  $grid[$ligne][$colonne];
                }
            }
            return $returnSquare;

        default:
            return [0,0,0,0,0,0,0,0,0,0];
    }
}

/**
 * Génère l'affichage de la grille
 * @return string
 */
function display(array $grid): string {

    $string =  "";
    foreach ($grid as $ligne){
        foreach ($ligne as $case){
            $string .= $case;
            $string .= " ";
        }
        $string .= PHP_EOL;
    }

    return $string;
}

/**
 * Teste si la valeur peut être ajoutée aux coordonnées demandées
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @param int $value Valeur
 * @return bool Résultat du test
 */
function isValueValidForPosition(array $grid, int $rowIndex, int $columnIndex, int $squareIndex,int $value): bool {
    //
    $data = [row($grid,$rowIndex),column($grid,$columnIndex),square($grid,$squareIndex)];

    foreach ($data as $listeNombres){
        foreach ($listeNombres as $nombre){
            if ($value == $nombre){
                return false;
            }
        }
    }
    return true;
}

/**
 * Retourne les coordonnées de la prochaine cellule à partir des coordonnées actuelles
 * (Le parcours est fait de gauche à droite puis de haut en bas)
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @return array Coordonnées suivantes au format [indexLigne, indexColonne]
 */

function getNextRowColumn(array $grid, int $rowIndex, int $columnIndex): array {
    if (($rowIndex == 8) && ($columnIndex == 8)){
        return [0,0];
    }
    else if($columnIndex == 8){
        return [$rowIndex + 1 , 1];
    }
    else {
        return [$rowIndex , $columnIndex + 1 ] ;
    }
 }

 function getPreviousRowColumn(array $grid, int $rowIndex, int $columnIndex): array {
    if (($rowIndex == 0) && ($columnIndex == 0)){
        return [8,8];
    }
    else if($columnIndex == 0){
        return [$rowIndex - 1 , 8];
    }
    else {
        return [$rowIndex , $columnIndex - 1 ] ;
    }
 }


 /**
 * Teste si la grille est valide
 * @return bool
 */

function isValid(array $grid): bool {
    //
    for ($index = 0; $index < 9; $index++) {
        if(count(array_unique(row($grid,$index))) !=9 or count(array_unique(column($grid,$index))) !=9 or count(array_unique(square($grid,$index))) !=9 ){
            return false;
        }
    }
    return true;
}

function solve(array $grid, int $rowIndex = 0, int $columnIndex = 0,int $squareIndex = 0): ?array {
    $value = 0;
    $columnIndex = 0;
    do {

        settype($rowIndex, "integer");
        settype($columnIndex, "integer");
        settype($squareIndex, "integer");
        // Sinon les 0 sont considérés comme null

        $contenuCase = get($grid,$rowIndex,$columnIndex);
        echo $rowIndex.$columnIndex.":".$contenuCase.PHP_EOL;

        // Si la case est vide
        if ($contenuCase == 0){
            if (isValueValidForPosition($grid,$rowIndex,$columnIndex,$squareIndex,$value)){
                set($grid,$rowIndex,$columnIndex,$value);

                if ($value == 10) { $value = 1;}
                else {$value++;}
            }
            else {
                $testCase = false;
                for ( $i = 1 ; $i < 10 ; $i++ ){
                    if (isValueValidForPosition($grid,$rowIndex,$columnIndex,$squareIndex,$i)){
                        $testCase = true;
                    }
                }

                if ($testCase == false){
                    // on augemente la valeur de la case précédente de 1
                    $valeurCasePrecedente = get($grid,$casePrecedente[0],$casePrecedente[1]);
                    $tableauValeursPossibles = [];

                    for ( $i = 1 ; $i < 10 ; $i++ ){
                        if (isValueValidForPosition($grid,$rowIndex,$columnIndex,$squareIndex,$i)){
                            $tableauValeursPossibles[] =  $i;
                        }
                    }

                    foreach ($tableauValeursPossibles as $valeurPossible) {
                        if ($valeurPossible > $valeurCasePrecedente){
                            set($grid,$casePrecedente[0],$casePrecedente[1],$valeurPossible);
                            break 2;
                        }
                    }

                }
            }
            // else if dans le cas ou aucun truc correspond
        }

        $prochaineCase = getNextRowColumn($grid,$rowIndex,$columnIndex);
        echo "procase";
        print_r($prochaineCase);
        echo PHP_EOL;
        $rowIndex = $prochaineCase[0];
        $columnIndex = $prochaineCase[1];

        $casePrecedente = [$rowIndex,$columnIndex];

        if (isValid($grid)){
            return $grid;
        }
    } while (true);



}

$dir = __DIR__ . '/grids';
$files = array_values(array_filter(scandir($dir), function($f){ return $f != '.' && $f != '..'; }));

foreach($files as $file){
    $filepath = realpath($dir . '/' . $file);
    echo("Chargement du fichier $file" . PHP_EOL);
    $grid = loadFromFile($filepath);
    echo(display($grid) . PHP_EOL);
    $startTime = microtime(true);
    echo("Début de la recherche de solution" . PHP_EOL);
    $solvedGrid = solve($grid, 0, 0);
    if($solvedGrid === null){
        echo("Echec, grille insolvable" . PHP_EOL);
    } else {
        echo("Reussite :" . PHP_EOL);
        echo(display($solvedGrid) . PHP_EOL);
    }

    $duration = round((microtime(true) - $startTime) * 1000);
    echo("Durée totale : $duration ms" . PHP_EOL);
    echo("--------------------------------------------------" . PHP_EOL);
}