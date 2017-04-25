export class Note {
    categorie : string[];
    titre: string[];
    date: string;
    contenu: string[];
    constructor(    categorie : string[] = "",titre: string[] = [],  date: string[]= [],
    contenu: string[] = []) {

        this.categorie = categorie;
        this.titre = titre;
        this.date = date;
        this.contenu = contenu;

    }
}
