 
function CUMPRINC(rate, periods, value, start, end, type) {
  // Credits: algorithm inspired by Apache OpenOffice
  // Credits: Hannes Stiebitzhofer for the translations of function and variable names

  rate = parseNumber(rate);
  periods = parseNumber(periods);
  value = parseNumber(value);
  if (anyIsError(rate, periods, value)) {
    return error.value;
  }

  // Return error if either rate, periods, or value are lower than or equal to zero
  if (rate <= 0 || periods <= 0 || value <= 0) {
    return error.num;
  }

  // Return error if start < 1, end < 1, or start > end
  if (start < 1 || end < 1 || start > end) {
    return error.num;
  }

  // Return error if type is neither 0 nor 1
  if (type !== 0 && type !== 1) {
    return error.num;
  }

  // Compute cumulative principal
  var payment = PMT(rate, periods, value, 0, type);
  var principal = 0;
  if (start === 1) {
    if (type === 0) {
      principal = payment + value * rate;
    } else {
      principal = payment;
    }
    start++;
  }
  for (var i = start; i <= end; i++) {
    if (type > 0) {
      principal += payment - (FV(rate, i - 2, payment, value, 1) - payment) * rate;
    } else {
      principal += payment - FV(rate, i - 1, payment, value, 0) * rate;
    }
  }

  // Return cumulative principal
  return principal;
}




function PMT(rate, periods, present, future, type) {
  // Credits: algorithm inspired by Apache OpenOffice

  future = future || 0;
  type = type || 0;

  rate = parseNumber(rate);
  periods = parseNumber(periods);
  present = parseNumber(present);
  future = parseNumber(future);
  type = parseNumber(type);
  if (anyIsError(rate, periods, present, future, type)) {
    return error.value;
  }

  // Return payment
  var result;
  if (rate === 0) {
    result = (present + future) / periods;
  } else {
    var term = Math.pow(1 + rate, periods);
    if (type === 1) {
      result = (future * rate / (term - 1) + present * rate / (1 - 1 / term)) / (1 + rate);
    } else {
      result = future * rate / (term - 1) + present * rate / (1 - 1 / term);
    }
  }
  return -result;
};


function FV(rate, periods, payment, value, type) {
  // Credits: algorithm inspired by Apache OpenOffice

  value = value || 0;
  type = type || 0;

  rate = parseNumber(rate);
  periods = parseNumber(periods);
  payment = parseNumber(payment);
  value = parseNumber(value);
  type = parseNumber(type);
  if (anyIsError(rate, periods, payment, value, type)) {
    return error.value;
  }

  // Return future value
  var result;
  if (rate === 0) {
    result = value + payment * periods;
  } else {
    var term = Math.pow(1 + rate, periods);
    if (type === 1) {
      result = value * term + payment * (1 + rate) * (term - 1) / rate;
    } else {
      result = value * term + payment * (term - 1) / rate;
    }
  }
  return -result;
};


function parseNumber(string) {
  if (string === undefined || string === '') {
    return error.value;
  }
  if (!isNaN(string)) {
    return parseFloat(string);
  }

  return error.value;
};


function anyIsError() {
  var n = arguments.length;
  while (n--) {
    if (arguments[n] instanceof Error) {
      return true;
    }
  }
  return false;
};
