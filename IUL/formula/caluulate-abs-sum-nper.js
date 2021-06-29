
function NPER(rate, payment, present, future, type) {
  type = (type === undefined) ? 0 : type;
  future = (future === undefined) ? 0 : future;

  rate = parseNumber(rate);
  payment = parseNumber(payment);
  present = parseNumber(present);
  future = parseNumber(future);
  type = parseNumber(type);
  if (anyIsError(rate, payment, present, future, type)) {
    return error.value;
  }

  // Return number of periods
  var num = payment * (1 + rate * type) - future * rate;
  var den = (present * rate + payment * (1 + rate * type));
  return Math.log(num / den) / Math.log(1 + rate);
};


function ROUND(number, digits) {
  number = parseNumber(number);
  digits = parseNumber(digits);
  if (anyIsError(number, digits)) {
    return error.value;
  }
  return Math.round(number * Math.pow(10, digits)) / Math.pow(10, digits);
};

 function SUM() {
  var result = 0;

  arrayEach(argsToArray(arguments), function(value) {
    if (typeof value === 'number') {
      result += value;

    } else if (typeof value === 'string') {
      var parsed = parseFloat(value);

      !isNaN(parsed) && (result += parsed);

    } else if (Array.isArray(value)) {
      result += exports.SUM.apply(null, value);
    }
  });

  return result;
};

function ABS(number) {
  number = parseNumber(number);
  if (number instanceof Error) {
    return number;
  }
  var result = Math.abs(number);

  return result;
};



arrayEach = function(array, iteratee) {
  var index = -1, length = array.length;

  while (++index < length) {
    if (iteratee(array[index], index, array) === false) {
      break;
    }
  }

  return array;
};


function argsToArray(args) {
  var result = [];

  arrayEach(args, function(value) {
    result.push(value);
  });

  return result;
};




function parseNumber(string) {
  if (string === undefined || string === '') {
    return error.value;
  }
  if (!isNaN(string)) {
    return parseFloat(string);
  }
  return error.value;
}

function anyIsError() {
  var n = arguments.length;
  while (n--) {
    if (arguments[n] instanceof Error) {
      return true;
    }
  }
  return false;
}
