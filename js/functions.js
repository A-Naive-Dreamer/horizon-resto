'use strict'

var horizonResto = angular.module('horizonResto', [])

horizonResto.constant('BACKGROUND_NAVS', angular.element('.background-navs'))
horizonResto.constant('BACKGROUNDS', angular.element('#backgrounds'))
horizonResto.constant('BACKGROUNDS_PATH', 'http://localhost/horizon-resto/media/pictures/')
horizonResto.constant('BACKGROUNDS_SOURCE', [])
horizonResto.constant('CUISINES', angular.element('#cuisines'))
horizonResto.constant('HEADER', angular.element('header'))
horizonResto.constant('LENGTH_OF_DINNER', angular.element('#length-of-dinner'))
horizonResto.constant('MESSAGE', angular.element('#message'))
horizonResto.constant('NUMBERS', angular.element('.numbers'))
horizonResto.constant('PLATES', angular.element('.plates'))
horizonResto.constant('PRICES', angular.element('.prices'))
horizonResto.constant('RESERVATION_DATE', angular.element('#reservation-date'))
horizonResto.constant('RESERVATION_TIME', angular.element('#reservation-time'))
horizonResto.constant('SEND', angular.element('#send'))
horizonResto.constant('TABLE_NUMBER', angular.element('#table-number'))
horizonResto.constant('TITLE', angular.element('#title'))

horizonResto.value('cuisines', [])
horizonResto.value('checkboxState', [])
horizonResto.value('navButton', undefined)
horizonResto.value('slide', undefined)
horizonResto.value('slidePointer', 0)

horizonResto.controller('mainController', function($interval, $scope, $window, BACKGROUND_NAVS, BACKGROUNDS, BACKGROUNDS_PATH, BACKGROUNDS_SOURCE, HEADER, TITLE,
    navButton, slide, slidePointer) {
    $scope.setPages = () => {
        if($window.innerWidth < 768) return

        for(let x = 1; x <= 5; ++x) BACKGROUNDS_SOURCE.push(BACKGROUNDS_PATH + x + '.jpg')

        BACKGROUND_NAVS.css({
            'top': ($window.innerHeight - 43) / 2
        })

        HEADER.css({
            'height': window.innerHeight - 57 + 'px'
        })

        BACKGROUNDS.css({
            'background-image': 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')'
        })

        ++slidePointer;

        for(let x = 1; x <= BACKGROUNDS_SOURCE.length; ++x) {
            navButton = document.createElement('div')

            navButton.className = 'nav-buttons'
            navButton.setAttribute('data-ng-click', 'toBackground(' + x + ')')

            BACKGROUNDS.append(navButton)
        }

        slide = $interval(function() {
            if(slidePointer >= BACKGROUNDS_SOURCE.length) slidePointer = 0

            BACKGROUNDS.css({
                'background-image': 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')'
            })

            ++slidePointer;
        }, 5000)

        slide

        $scope.moveSlide()
    }

    $scope.moveSlide = () => {
        if(angular.isDefined(slide)) return

        slide = $interval(function() {
            if(slidePointer >= BACKGROUNDS_SOURCE.length) slidePointer = 0

            BACKGROUNDS.css('background-image', 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')')

            ++slidePointer;
        }, 5000)
    }

    $scope.destroyInterval = () => {
        if(!angular.isDefined(slide)) return

        $interval.cancel(slide)

        slide = undefined
    }

    $scope.previousBackground = () => {
        --slidePointer

        if(slidePointer < 0) slidePointer = BACKGROUNDS_SOURCE.length - 1

        BACKGROUNDS.css('background-image', 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')')
    }

    $scope.nextBackground = () => {
        ++slidePointer;

        if(slidePointer >= BACKGROUNDS_SOURCE.length) slidePointer = 0;

        BACKGROUNDS.css('background-image', 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')')
    }

    $scope.toBackground = x => {
        if(x >= 0 && x < BACKGROUNDS_SOURCE.length) {
            slidePointer = x

            BACKGROUNDS.css({
                'background-image': 'url(' + BACKGROUNDS_SOURCE[slidePointer] + ')'
            })
        }
    }
})

horizonResto.controller('cuisineMenu', function($http, $scope) {
    $scope.editCuisine = (x) => {
        location.assign('http://localhost/horizon-resto/site/index.php/pages/section/edit/' + x)
    }
    $scope.addCuisine = (x) => {
        location.assign('http://localhost/horizon-resto/site/index.php/pages/section/add-cuisine')
    }
    $scope.deleteCuisine = (x) => {
        location.assign('http://localhost/horizon-resto/site/index.php/pages/section/delete-cuisine/' + x)
    }
})

horizonResto.controller('admin', function($http, $scope) {
        $scope.checkPrivelege = () => {
            let test = sessionStorage.getItem('user')

            /*if(test !== '') {
                const USER = JSON.parse(sessionStorage.getItem('user'))

                if(USER.levelId != '1') {
                    location.assign('http://localhost/horizon-resto/site/index.php/pages/section/home')
                }
            }*/

            location.assign('http://localhost/horizon-resto/site/index.php/pages/section/home')
        }
})

horizonResto.controller('myOrders', function($http, $scope) {
    $scope.cancel = (x) => {
        $http.get('http://localhost/horizon-resto/site/index.php/pages/section/cancel/' + x).then(function(response) {
            location.reload()
        })
    }
})

horizonResto.controller('cashierTable', function($http, $scope) {
    $scope.checkDone = (x) => {
        $http.get('http://localhost/horizon-resto/site/index.php/pages/section/check-done/' + x).then(function(response) {
            location.reload()
        })
    }
})

horizonResto.controller('user', function($http, $scope, CUISINES, MESSAGE, NUMBERS, PLATES, PRICES,
    RESERVATION_DATE, RESERVATION_TIME, SEND, TABLE_NUMBER, checkboxState, cuisines) {
    $scope.checkPrivelege = () => {
        let test = sessionStorage.getItem('user')

        /*if(test === '') {
            location.assign('http://localhost/horizon-resto/site/index.php/pages/section/home')
        }*/
    }

    $scope.send = () => {
        checkboxState.forEach(function(item, index) {
            cuisines.push([
                parseInt(NUMBERS[index].value),
                parseInt(PLATES.eq(index).attr('value')),
                parseInt(PRICES.eq(index).text())
            ])
        })

        CUISINES.val(JSON.stringify(cuisines))

        if(MESSAGE.val() !== '' && RESERVATION_DATE.val() !== '' && RESERVATION_TIME.val() !== '' && TABLE_NUMBER.val() !== '' && 
            cuisines.length > 0) {
            let ajax = new XMLHttpRequest(),
                data = 'message=' + encodeURIComponent(MESSAGE.val()) + '&reservation_date=' + encodeURIComponent(RESERVATION_DATE.val()) + 
                    '&reservation_time=' + encodeURIComponent(RESERVATION_TIME.val()) + '&table_number=' + encodeURIComponent(TABLE_NUMBER.val()) + 
                    '&cuisines=' + JSON.stringify(cuisines)

            console.log(data)
            
            /*ajax.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    if(this.responseText == 'true') {
                        location.assign('http://localhost/horizon-resto/site/index.php/pages/section/home')
                    } else {
                        location.assign('http://localhost/horizon-resto/site/index.php/pages/section/booking')
                    }
                }
            }

            ajax.open('POST', 'http://localhost/horizon-resto/site/index.php/pages/section/order')
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            ajax.send(data)*/
            SEND.click()
        }
    }

    $scope.createBookingPage = () => {
        for(let x = 0; x < PLATES.length; ++x) {
            checkboxState.push(false)
        }
    }

    $scope.select = x => {
        if(checkboxState[x]) {
            checkboxState[x] = false
        } else {
            checkboxState[x] = true
        }
    }
})
