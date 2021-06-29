
function CUMIPMT(r, e, t, a, o, f) {
  if (((r = parseNumber(r)), (e = parseNumber(e)), (t = parseNumber(t)), anyIsError(r, e, t))) return value;
  if (r <= 0 || e <= 0 || t <= 0) return num;
  if (a < 1 || o < 1 || a > o) return num;
  if (0 !== f && 1 !== f) return num;
  var s = PMT(r, e, t, 0, f), 
      l = 0;
  1 === a && (0 === f && (l = -t), a++);
  for (var c = a; c <= o; c++) l += 1 === f ? FV(r, c - 2, s, t, 1) - s : FV(r, c - 1, s, t, 0);
  return (l *= r);
}

function PMT(r, n, e, t, a) {
  if (((t = t || 0), (a = a || 0), (r = parseNumber(r)), (n = parseNumber(n)), (e = parseNumber(e)), (t = parseNumber(t)), (a = parseNumber(a)), anyIsError(r, n, e, t, a))) return value;
  var o;
  if (0 === r) o = (e + t) / n;
  else {
      var f = Math.pow(1 + r, n);
      o = 1 === a ? ((t * r) / (f - 1) + (e * r) / (1 - 1 / f)) / (1 + r) : (t * r) / (f - 1) + (e * r) / (1 - 1 / f);
  }
  return -o;
}

function FV(r, n, e, t, a) {
  if (((t = t || 0), (a = a || 0), (r = parseNumber(r)), (n = parseNumber(n)), (e = parseNumber(e)), (t = parseNumber(t)), (a = parseNumber(a)), anyIsError(r, n, e, t, a))) return value;
  var o;
  if (0 === r) o = t + e * n;
  else {
      var f = Math.pow(1 + r, n);
      o = 1 === a ? t * f + (e * (1 + r) * (f - 1)) / r : t * f + (e * (f - 1)) / r;
  }
  return -o;
}
 
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
