<script>
    const city = "Licab, Nueva Ecija, Philippines";
    const year = 2024;
    const apiKey = "ZGXCYVYQ44P8YTYQ28V3C56VG";
    const averagePrecipitationData = [];
    const dataLastYear = [
    33.722,
    0,
    44.20900000000001,
    0.073,
    104.331,
    209.36699999999996,
    637.624,
    274.701,
    620.579,
    203.851,
    101.43599999999999,
    24.095
    ]
    // const dataLastYear = [1.0878064516129033, 0, 1.4260967741935486, 0.0024333333333333334, 3.365516129032258, 6.9788999999999985, 20.568516129032258, 8.861322580645162, 20.685966666666666, 6.575838709677419, 3.3811999999999998, 0.777258064516129]

    //fetch data

    // Delay helper function (returns a Promise that resolves after a delay)
    // function delay(ms) {
    //     return new Promise(resolve => setTimeout(resolve, ms));
    // }

    // async function fetchMonthlyPrecipitation(month) {
    //     const start = `${year}-${String(month).padStart(2, '0')}-01`;
    //     const end = new Date(year, month, 0); // Get last day of the month
    //     const endDate = `${year}-${String(month).padStart(2, '0')}-${String(end.getDate()).padStart(2, '0')}`;
    //     const url = `https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/${encodeURIComponent(city)}/${start}/${endDate}?unitGroup=metric&key=${apiKey}&include=days`;
    //     try {
    //         const res = await fetch(url);
    //         const data = await res.json();

    //         let count = 0;
    //         let sum = 0;

    //         data.days.forEach(day => {
    //             console.log(`Date: ${day.datetime}, Precipitation: ${day.precip} mm`);
    //             sum += day.precip || 0;
    //             count++;
    //         });

    //         // const average = count > 0 ? sum / count : 0;
    //         averagePrecipitationData.push(sum);
    //         // console.log(`Average for ${start} to ${endDate}: ${average.toFixed(2)} mm`);
    //     } catch (err) {
    //         console.error(`Error fetching data for ${start}:`, err);
    //     }
    // }

    // async function fetchAllMonths() {
    //     for (let month = 1; month <= 12; month++) {
    //         await fetchMonthlyPrecipitation(month);
    //         await delay(1000); // Wait 1 second to avoid hitting rate limits
    //     }

    //     // Log final array after all fetches are complete
    //     console.log("Monthly Average Precipitation:", averagePrecipitationData);
    // }

    // fetchAllMonths();
</script>
