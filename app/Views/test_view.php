<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Call JS Function</title>
</head>

<body>
    <script>
    let Arr = [2,5,8,12,16,23,38,56,72,91];
    let inputArr = [5, 2, 4, 6, 1, 3];
    let inputStat = [1, 2, 11, 1, 1, 1];
    let sus = [5,1,5,1,5,1,5,1,5,1];
    let data = [
  [5, 1, 5, 1, 5, 1, 5, 1, 5, 1],
  [1, 5, 1, 5, 1, 5, 1, 5, 1, 5],
  [4, 2, 4, 2, 4, 2, 4, 2, 4, 2],
  [2, 4, 2, 4, 2, 4, 2, 4, 2, 4],
  [3, 4, 5, 1, 5, 3, 4, 2, 4, 5]
];

    function selectionSort(inputArr) {
        let n = inputArr.length;
        for (var i = 0; i < n-1; i++){
            var min_idx = i;
            for (var j = i+1; j < n; j++){
                if(inputArr[min_idx] > inputArr[j]){
                    min_idx = j;
                }
            }
            if(min_idx != i){
                temp = inputArr[min_idx];
                inputArr[min_idx] = inputArr[i];
                inputArr[i] = temp;
            }
        }
        console.log(inputArr);
    }

    function insertionSort(inputArr){
        let n = inputArr.length;
        for (var i = 1; i < n; i++){
            current = inputArr[i];
            var j = i-1;
            while (j>-1 && current < inputArr[j]){
                inputArr[j+1] = inputArr[j];
                j--;
            }
            inputArr[j+1] = current;
        }
        console.log(inputArr);
    }
    
    // function bubbleSort(inputArr){
    //     let n = inputArr.length;
    //     for(var i = 0; i < n-1; i++){
    //         let isSwapped = false;
    //         for(var j = 0; j < n-i-1;j++){
    //             if(inputArr[j+1] < inputArr[j]){
    //                 temp = inputArr[j+1];
    //                 inputArr[j+1] = inputArr[j];
    //                 inputArr[j] = temp;
    //                 isSwapped = true;
    //             }
    //         }
    //         if(!isSwapped){
    //             console.log("iterasi berakhir pada i ke-",i, 'dan j ke-',j);
    //             console.log(inputArr);
    //             break;
    //         }
    //     }
    //     console.log(inputArr);
    // }

    // function binarySearch(Arr){
    //     let start = 0;
    //     let end = Arr.length;
    //     let searchKey = 23;
    //     let found = false;
    //     while(start<=end){
    //         let middle = Math.floor((start + end)/2);
    //         if(Arr[middle] == searchKey){
    //             console.log("Element Found At Index-",middle);
    //             found = true;
    //             break;
    //         } else if (Arr[middle] < searchKey){
    //             start = middle +1;
    //         } else {
    //             end = middle - 1;
    //         }
    //     }
    //     if(!found){
    //         console.error('Something Went Wrong!!!');
    //     }
    // }

    function binarySearch(Arr){
        let start = 0;
        let end = Arr.length;
        let searchKey = 23;
        while(start<=end){
            let middle = Math.floor((start +end)/2);
            if(Arr[middle] == searchKey){
                console.log("Element Found At Index-", middle);
                break;
            } else if(Arr[middle] < searchKey){
                start = middle +1;
            } else{
                end = middle -1;
            }
        }
    }

    function susCalc1array(sus){
        let n = sus.length;
        let pos = [];
        let neg = [];
        let indexpos = 0;
        let indexneg =0;
        let sumpos = 0;
        let sumneg = 0;
        for (var i = 0; i < n; i++){
            if (i % 2 == 0){
                pos[indexpos] = sus[i] -1;
                indexpos++;
            } else {
                neg[indexneg] = 5 - sus[i];
                indexneg++;
            }
        }
        for (var j = 0; j < pos.length; j++){
            sumpos = sumpos + pos[j];
            sumneg = sumneg + neg[j];
        }
        var finalscore = (sumpos + sumneg)*2.5;
        console.log('Final Score', finalscore);
        console.log('Sum Positif', sumpos);
        console.log('Sum Negatif', sumneg);
        console.log('Positif', pos);
        console.log('Negatif', neg);
    }

    // function susCalc(data){
    //     let n = data.length;
    //     let nn = data[0].length;
    //     var finalscore = [];
    //     var total = 0;
    //     var rata2 = 0;
    //     for (var i = 0; i < n; i++){
    //         let pos = [];
    //         let neg = [];
    //         let indexpos = 0;
    //         let indexneg = 0;
    //         let sumpos = 0;
    //         let sumneg = 0;
    //         for (var j = 0; j< nn; j++){
    //             if(j % 2 == 0){
    //                 pos[indexpos] = data[i][j] - 1;
    //                 indexpos++;
    //             } else {
    //                 neg[indexneg] = 5 - data[i][j];
    //                 indexneg++;
    //             }
    //         }
    //         for (var k = 0; k < pos.length; k++){
    //             sumpos = sumpos + pos[k];
    //             sumneg = sumneg + neg[k];
    //         }
            // finalscore[i] = ((sumpos + sumneg)*2.5);
            // console.log("ITERASI KE", i);
            // console.log("Positif = ", pos);
            // console.log("Negatif = ", neg);
            // console.log("Sum Positif = ", sumpos);
            // console.log("Sum Negatif = ", sumneg);
            // console.log("SKOR FINAL= ", finalscore[i]);
    //     }
    //     console.log(finalscore);     
    //     for(var l = 0; l < finalscore.length; l++){
    //         total = total + finalscore[l];
    //         if ((l+1) == finalscore.length){
    //             rata2 = total/finalscore.length;
    //         }
    //     }
    //     console.log('Rata-Rata = ' ,rata2)
    // }

    function susCalc(data){
        let n = data.length;
        let nn = data[0].length;
        let total = 0;
        let rata = 0;
        let finalscore = [];
        for (var i = 0; i<n; i++){
            let pos = [];
            let neg = [];
            let indexpos = 0;
            let indexneg = 0;
            let sumpos = 0;
            let sumneg = 0;
            for (var j=0; j<nn;j++){
                if( j % 2 == 0){
                    pos[indexpos] = data[i][j] - 1;
                    indexpos++;
                } else{
                    neg[indexneg] = 5 - data[i][j];
                    indexneg++;
                }
            }
            for (var k = 0; k<pos.length; k++){
                sumpos = sumpos + pos[k];
                sumneg = sumneg + neg[k];
            }
            finalscore[i] = ((sumpos + sumneg)*2.5);
            console.log("Final Score Array ke-",i, '=',finalscore[i]);
        }
        for (var l = 0; l < finalscore.length; l++){
            total = total + finalscore[l];
            if((l+1) == finalscore.length){
                rata = total/finalscore.length;
            }
        }
        console.log('Rata Rata =', rata);
    }

    function statistikaDeskriptif(inputStat){
        var statData = inputStat.split(",");
        let n = inputStat.length;
        let ratarata = 0;
        let total = 0;
        let sum = 0;
        for (var i = 0; i < n; i++){
            total = total + inputStat[i];
        }
        ratarata = total/n;
        for (var j = 0; j < n; j++){
            sum = sum + (((inputStat[j] - ratarata) ** 2)/(n-1));
        }
        let stdv = Math.sqrt(sum);
        let nn = 0.4;
        let batasatas = ratarata + (nn * stdv);
        let batasbawah = ratarata - (nn * stdv);
        console.log('Standar Deviasi =',stdv);
        console.log('Batas Atas =',batasatas);
        console.log('Batas Bawah =',batasbawah);
    }

    // function statistikaDeskriptif(inputStat){
        
    //     let n = inputStat.length;
    //     let total = 0;
    //     let sum =0;
    //     for (var i = 0; i<n; i++){
    //         total = total + inputStat[i];
    //     }
    //     let rata = total/n;
    //     for(var j = 0; j<n; j++){
    //         sum = sum + (((inputStat[j] - rata) ** 2)/ (n-1));
    //     }
    //     let stdv = Math.sqrt(sum);
    //     let nn = 0.4;
    //     let batasatas = rata + (nn * stdv);
    //     let batasbawah = rata - (nn * stdv);
    //     console.log('Standar Deviasi =',stdv);
    //     console.log('Batas Atas =',batasatas);
    //     console.log('Batas Bawah =',batasbawah);
    // }
</script>
<div>
    <div class = "row">
        <input type= "text" name = "statdes">
    </div>
</div>
    <?php echo '<script>
    susCalc(data);
    </script>'; ?>
</body>
</html>
