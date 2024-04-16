// Fonction pour yumitype "banner81"
function banner81(yumiadsElement, yumisource) {
    if (yumisource == "RAND") {
        console.log(`Fonction pour yumitype "banner81" appelée avec yumiadsElement : ${yumiadsElement} et yumisource : ${yumisource}`);
        yumiadsElement.style.backgroundImage = `url("https://stream.yuminako.com/assets/ads/${Math.floor(Math.random() * 3) + 1}.gif")`;
    }else{
        yumiadsElement.style.backgroundImage = `url(${yumisource})`;
    }
}

// Fonction pour yumitype "banner11"
function banner11(yumiadsElement, yumisource) {
    console.log(`Fonction pour yumitype "banner11" appelée avec yumiadsElement : ${yumiadsElement} et yumisource : ${yumisource}`);
}

// Fonction pour yumitype "banner13"
function banner13(yumiadsElement, yumisource) {
    console.log(`Fonction pour yumitype "banner13" appelée avec yumiadsElement : ${yumiadsElement} et yumisource : ${yumisource}`);
}

const elements = document.querySelectorAll('#yumiads');
elements.forEach(element => {
    let tags = element.getAttribute('tags');
    if (!tags) {
        const yumitype = element.getAttribute('yumitype');
        const yumisource = element.getAttribute('yumisource');
        if (yumitype || yumisource) {
            if (yumitype == "banner81") {
                banner81(element, yumisource);
            } else if (yumitype == "banner11") {
                banner11(element, yumisource);
            } else if (yumitype == "banner13") {
                banner13(element, yumisource);
            } else {
                console.error("YUMIADS : Your code is Broken [YUMITYPE_NOT_FOUND]");
            }
        }else{
            console.error("YUMIADS : Your code is Broken [YUMITYPE_YUMISOURCE_NOT_FOUND]");
            console.log({yumitype, yumisource})
        }
    } else {
        console.error("YUMIADS : Your code is Broken [ATTRIBUTES_NOT_FOUND]");
    }
});
