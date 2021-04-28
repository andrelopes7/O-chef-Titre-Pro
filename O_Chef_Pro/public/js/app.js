const recipeList = document.getElementById('recipeList');
const searchBar = document.getElementById('searchBar')
let recipe = [];
/* console.log(searchBar); */

searchBar.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();

    const filteredRecipes = recipes.filter((recipe) => {
      
        return recipe.name.toLowerCase().includes(searchString);
    });

    displayRecipes(filteredRecipes);
}); 



const loadRecipes = async () => {
    try {
        const res = await fetch('http://localhost:8080/api/recipes');
        recipes = await res.json();
        displayRecipes(recipe);
        console.log(recipe);
    } catch (err) {
        console.error(err);
    }
};

const displayRecipes = (recipe) => {
    const htmlString = recipe
        .map((recipeses) => {
            return `
            <li class="character">
                <h2>${recipes.name}</h2>
                <p>House: ${recipes.description}</p>
                <img src="${recipes.pictureFile}"></img>
            </li>
        `;
        })
        .join('');
    recipeList.innerHTML = htmlString;
};

loadRecipes();