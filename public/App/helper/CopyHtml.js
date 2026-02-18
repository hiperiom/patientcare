export function CopyHtml(selector){
    const   $copy = document.getElementById(selector).content;
            return document.importNode($copy,true);
}
