document.addEventListener('DOMContentLoaded', function() {
    // Debugging - cek apakah container chart ada
    const chartContainer = document.querySelector("#chart-profile-visit");
    if (!chartContainer) {
        console.error('Chart container not found!');
        return;
    }

    // Handle missing or invalid data
    const monthlyIncome = window.monthlyIncome || Array(12).fill(0);
    console.log('Processed Monthly Income:', monthlyIncome);

    // Jika semua data 0, beri warning
    if (Object.values(monthlyIncome).every(val => val === 0)) {
        console.warn('All monthly income data is zero - using sample data for demo');
        // Untuk debugging, kita bisa gunakan data contoh
        for (let i = 0; i < 12; i++) {
            monthlyIncome[i+1] = Math.floor(Math.random() * 1000000) + 500000;
        }
    }

    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300,
            events: {
                mounted: function(ctx, config) {
                    console.log('Chart mounted successfully');
                },
                error: function(err) {
                    console.error('Chart error:', err);
                }
            }
        },
        fill: {
            opacity: 1
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
            }
        },
        series: [{
            name: 'Pemasukan',
            data: Object.values(monthlyIncome)
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        }
    };

    try {
        var chartProfileVisit = new ApexCharts(chartContainer, optionsProfileVisit);
        chartProfileVisit.render();
        console.log('Chart rendered successfully');
    } catch (error) {
        console.error('Failed to render chart:', error);
        
        // Fallback - tampilkan pesan error di container chart
        chartContainer.innerHTML = '<div class="alert alert-danger">Gagal memuat grafik. ' + error.message + '</div>';
    }

    // Chart lainnya tetap sama...
    let optionsVisitorsProfile = {
        // ... (kode yang sama)
    };

    var optionsEurope = {
        // ... (kode yang sama)
    };

    let optionsAmerica = { ...optionsEurope, colors: ['#008b75'] };
    let optionsIndonesia = { ...optionsEurope, colors: ['#dc3545'] };

    // Render chart lainnya dengan error handling
    try {
        var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile);
        var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
        var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
        var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

        chartIndonesia.render();
        chartAmerica.render();
        chartEurope.render();
        chartVisitorsProfile.render();
    } catch (error) {
        console.error('Error rendering other charts:', error);
    }
});