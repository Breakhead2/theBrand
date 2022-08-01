function checkPattern(id, value){
    switch (id){
        case 'country':
        case 'city':
        case 'fio':
        case 'firstName':
        case 'secondName':
            const countryAndCityPattern = new RegExp("[а-яА-Я-+]");
            return countryAndCityPattern.test(value);
        case 'postcode':
            const postcodePattern = new RegExp("\\d{6}");
            return postcodePattern.test(value);
        case 'phone':
            const phonePattern = new RegExp('(\\+7|8)[\\s{1}(]*\\d{3}[)\\s{1}]*\\d{3}[\\s-]?\\d{2}[\\s-]?\\d{2}', 'g');
            //+7 (999) 999-99-99
            return phonePattern.test(value);
        case 'email':
            const emailPattern = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");
            return emailPattern.test(value);
        case 'password':
            if(value.length < 8){
                return false;
            }
            const passPattern = new RegExp(".*([a-z]+[A-Z]+[0-9]+|[a-z]+[0-9]+[A-Z]+|[A-Z]+[a-z]+[0-9]+|[A-Z]+[0-9]+[a-z]+|[0-9]+[a-z]+[A-Z]+|[0-9]+[A-Z]+[a-z]+).*");
            return passPattern.test(value);
    }
}
export default checkPattern;