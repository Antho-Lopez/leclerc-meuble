
let start_date = document.querySelector('#start_date');
let end_date = document.querySelector('#end_date');
let nb_max = document.querySelector('#nb_max');
let popularity = document.querySelector('#popularity');
console.log(popularity.value);

start_date.addEventListener('change', (event) => {
    setTimeout(() => {getDateStat()}, 250);
});
end_date.addEventListener('change', (event) => {
    setTimeout(() => {getDateStat()}, 250);
});
nb_max.addEventListener('change', (event) => {
    setTimeout(() => {getDateStat()}, 250);
});
popularity.addEventListener('change', (event) => {
    console.log(popularity.value);
    setTimeout(() => {getDateStat()}, 250);
});

getDateStat()

async function getDateStat() {

    await axios.get(`/api/stat?from=${start_date.value}&to=${end_date.value}&max=${nb_max.value}&popularity=${popularity.value}`)
    .then(function (response) {
        // STATISTIQUES CATEGORIES
        let CategoryClick = response.data.category
        let labelCategory = [];
        let dataCategory = [];

        for (const key in CategoryClick) {
            const element = CategoryClick[key];
            labelCategory.push(key)
            dataCategory.push(element.length)
        }

        const data = {
            labels: labelCategory,
            datasets: [
            {
                label: 'Catégories',
                data: dataCategory,
                borderColor: 'rgb(83,164,207,0.6)',
                backgroundColor: 'rgb(83,164,207,0.6)',
            }
            ]
        };

        const ctxclickpercategory = document.getElementById('clickpercategory').getContext('2d');
        if (Chart.getChart("clickpercategory")){
            Chart.getChart("clickpercategory").destroy();
        }
        const category = new Chart(ctxclickpercategory, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                    position: 'top',
                    }
                }
            },
        });

        // STATISTIQUES COLLECTIONS
        let CollectionClick = response.data.collection
        let labelCollection = [];
        let dataCollection = [];

        for (const key in CollectionClick) {
            const element = CollectionClick[key];
            labelCollection.push(key)
            dataCollection.push(element.length)
        }

        const data2 = {
            labels: labelCollection,
            datasets: [
            {
                label: 'Collections',
                data: dataCollection,
                borderColor: 'rgb(56,186,125,0.6)',
                backgroundColor: 'rgb(56,186,125,0.6)',
            }
            ]
        };

        const ctxclickpercollection = document.getElementById('clickpercollection').getContext('2d');
        if (Chart.getChart("clickpercollection")){
            Chart.getChart("clickpercollection").destroy();
        }
        const collection = new Chart(ctxclickpercollection, {
            type: 'bar',
            data: data2,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                    position: 'top',
                    }
                }
            },
        });

        // STATISTIQUES PRODUCTS
        let ProductClick = response.data.product
        let labelProduct = [];
        let dataProduct = [];

        for (const key in ProductClick) {
            const element = ProductClick[key];
            labelProduct.push(key)
            dataProduct.push(element.length)
        }

        const data3 = {
            labels: labelProduct,
            datasets: [
            {
                label: 'Produits',
                data: dataProduct,
                borderColor: 'rgb(253,187,12,0.6)',
                backgroundColor: 'rgb(253,187,12,0.6)',
            }
            ]
        };

        const ctxclickperproduct = document.getElementById('clickperproduct').getContext('2d');
        if (Chart.getChart("clickperproduct")){
            Chart.getChart("clickperproduct").destroy();
        }
        const product = new Chart(ctxclickperproduct, {
            type: 'bar',
            data: data3,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                    position: 'top',
                    }
                }
            },
        });
    })
}
