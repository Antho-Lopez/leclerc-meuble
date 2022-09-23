
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

        // COME FROM STAT
        let ComeFromClick = response.data.come_from
        let LabelComeFrom = [];
        let dataComeFrom= [];

        for (const key in ComeFromClick) {
            const element = ComeFromClick[key];
            LabelComeFrom.push(key)
            dataComeFrom.push(element.length)
        }

        const data4 = {
            labels: LabelComeFrom,
            datasets: [
            {
                label: 'Provenance du client',
                data: dataComeFrom,
                borderColor:  'rgba(255, 159, 64, 0.6)',
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
            }
            ]
        };


        const ctxcomefrom = document.getElementById('come_from').getContext('2d');
        if (Chart.getChart("come_from")){
            Chart.getChart("come_from").destroy();
        }
        const comefrom = new Chart(ctxcomefrom, {
            type: 'bar',
            data: data4,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                    position: 'top',
                    }
                }
            },
        });


        // NB CLIENT AND PLATFORM STAT
          let NbClientClick = response.data.nb_client
          let LabelNbClient = [];
          let dataNbClient= [];

          for (const key in NbClientClick) {
              const element = NbClientClick[key];
              LabelNbClient.push(key)
              dataNbClient.push(element.length)
          }

          const data5 = {
              labels: LabelNbClient,
              datasets: [
              {
                  label: 'Nombre de client',
                  data: dataNbClient,
                  borderColor: 'rgba(75, 192, 192, 0.6)',
                  backgroundColor: 'rgba(75, 192, 192, 0.6)',
              }
              ]
          };


          const ctxnbclient = document.getElementById('nb_client').getContext('2d');
          if (Chart.getChart("nb_client")){
              Chart.getChart("nb_client").destroy();
          }
          const nbclient = new Chart(ctxnbclient, {
              type: 'bar',
              data: data5,
              options: {
                  responsive: true,
                  plugins: {
                      legend: {
                      position: 'top',
                      }
                  }
              },
          });

           // NB CLICK PAR CATALOGUES
           let NbClickCataClick = response.data.nb_click_cata
           let LabelNbClickCata = [];
           let dataNbClickCata = [];

           for (const key in NbClickCataClick) {
               const element = NbClickCataClick[key];
               LabelNbClickCata.push(key)
               dataNbClickCata.push(element.length)
           }

           const data6 = {
               labels: LabelNbClickCata,
               datasets: [
               {
                   label: 'Nombre de clics par catalogues',
                   data: dataNbClickCata,
                   borderColor: 'rgba(153, 102, 255, 0.6)',
                   backgroundColor: 'rgba(153, 102, 255, 0.6)',
               }
               ]
           };


           const ctxnbclickcata = document.getElementById('nb_click_cata').getContext('2d');
           if (Chart.getChart("nb_click_cata")){
               Chart.getChart("nb_click_cata").destroy();
           }
           const nbclickcata = new Chart(ctxnbclickcata, {
               type: 'bar',
               data: data6,
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
