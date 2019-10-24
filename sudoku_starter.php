<?php

/**
 * Charge un fichier en fournissant son chemin
 * @param string $filepath Chemin du fichier
 * @return array|null Un tableau si le fichier existe et est valide, null sinon
 */
function loadFromFile(string $filepath): ?array {
    // Get the contents of the JSON file
    $contenuFichierJson = file_get_contents($filepath);
    if ($contenuFichierJson === false) {
        return null;
    }

    // Convert to array
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
    //
}

/**
 * Affecte une valeur dans une cellule
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @param int $value Valeur
 */
function set(array $grid, int $rowIndex, int $columnIndex, int $value): void {
    //
}

/**
 * Retourne les données d'une ligne à partir de son index
 * @param int $rowIndex Index de ligne (entre 0 et 8)
 * @return array Chiffres de la ligne demandée
 */
function row(array $grid, int $rowIndex): array {
    //
}

/**
 * Retourne les données d'une colonne à partir de son index
 * @param int $columnIndex Index de colonne (entre 0 et 8)
 * @return array Chiffres de la colonne demandée
 */
function column(array $grid, int $columnIndex): array {
    //
}

/**
 * Retourne les données d'un bloc à partir de son index
 * L'indexation des blocs est faite de gauche à droite puis de haut en bas
 * @param int $squareIndex Index de bloc (entre 0 et 8)
 * @return array Chiffres du bloc demandé
 */
function square(array $grid, int $squareIndex): array {
    //
}

/**
 * Génère l'affichage de la grille
 * @return string
 */
function display(array $grid): string {
    //
    foreach ($grid as $ligne){
        foreach ($ligne as $case){
            echo $case . " ";
        }
        echo  PHP_EOL;
    }
}

/**
 * Teste si la valeur peut être ajoutée aux coordonnées demandées
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @param int $value Valeur
 * @return bool Résultat du test
 */
function isValueValidForPosition(array $grid, int $rowIndex, int $columnIndex, int $value): bool {
    //
}

/**
 * Retourne les coordonnées de la prochaine cellule à partir des coordonnées actuelles
 * (Le parcours est fait de gauche à droite puis de haut en bas)
 * @param int $rowIndex Index de ligne
 * @param int $columnIndex Index de colonne
 * @return array Coordonnées suivantes au format [indexLigne, indexColonne]
 */
function getNextRowColumn(array $grid, int $rowIndex, int $columnIndex): array {
    //
}

/**
 * Teste si la grille est valide
 * @return bool
 */
function isValid(array $grid): bool {
    //
}

function solve(array $grid, int $rowIndex, int $columnIndex): ?array {
    //
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
    $solvedGrid = solve($grid);
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