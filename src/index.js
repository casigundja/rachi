var __create = Object.create;
var __defProp = Object.defineProperty;
var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
var __getOwnPropNames = Object.getOwnPropertyNames;
var __getProtoOf = Object.getPrototypeOf;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __name = (target2, value) => __defProp(target2, "name", { value, configurable: true });
var __require = /* @__PURE__ */ ((x) => typeof require !== "undefined" ? require : typeof Proxy !== "undefined" ? new Proxy(x, {
  get: (a, b) => (typeof require !== "undefined" ? require : a)[b]
}) : x)(function(x) {
  if (typeof require !== "undefined") return require.apply(this, arguments);
  throw Error('Dynamic require of "' + x + '" is not supported');
});
var __commonJS = (cb, mod) => function __require2() {
  try {
    return mod || (0, cb[__getOwnPropNames(cb)[0]])((mod = { exports: {} }).exports, mod), mod.exports;
  } catch (e) {
    throw mod = 0, e;
  }
};
var __copyProps = (to, from, except, desc) => {
  if (from && typeof from === "object" || typeof from === "function") {
    for (let key of __getOwnPropNames(from))
      if (!__hasOwnProp.call(to, key) && key !== except)
        __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
  }
  return to;
};
var __toESM = (mod, isNodeMode, target2) => (target2 = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
  // If the importer is in node compatibility mode or this is not an ESM
  // file that has been converted to a CommonJS file using a Babel-
  // compatible transform (i.e. "__esModule" has not been set), then set
  // "default" to the CommonJS "module.exports" for node compatibility.
  isNodeMode || !mod || !mod.__esModule ? __defProp(target2, "default", { value: mod, enumerable: true }) : target2,
  mod
));

// node-built-in-modules:events
import libDefault from "events";
var require_events = __commonJS({
  "node-built-in-modules:events"(exports, module) {
    module.exports = libDefault;
  }
});

// node_modules/postgres-array/index.js
var require_postgres_array = __commonJS({
  "node_modules/postgres-array/index.js"(exports) {
    "use strict";
    exports.parse = function(source, transform) {
      return new ArrayParser(source, transform).parse();
    };
    var ArrayParser = class _ArrayParser {
      static {
        __name(this, "ArrayParser");
      }
      constructor(source, transform) {
        this.source = source;
        this.transform = transform || identity;
        this.position = 0;
        this.entries = [];
        this.recorded = [];
        this.dimension = 0;
      }
      isEof() {
        return this.position >= this.source.length;
      }
      nextCharacter() {
        var character = this.source[this.position++];
        if (character === "\\") {
          return {
            value: this.source[this.position++],
            escaped: true
          };
        }
        return {
          value: character,
          escaped: false
        };
      }
      record(character) {
        this.recorded.push(character);
      }
      newEntry(includeEmpty) {
        var entry;
        if (this.recorded.length > 0 || includeEmpty) {
          entry = this.recorded.join("");
          if (entry === "NULL" && !includeEmpty) {
            entry = null;
          }
          if (entry !== null) entry = this.transform(entry);
          this.entries.push(entry);
          this.recorded = [];
        }
      }
      consumeDimensions() {
        if (this.source[0] === "[") {
          while (!this.isEof()) {
            var char = this.nextCharacter();
            if (char.value === "=") break;
          }
        }
      }
      parse(nested) {
        var character, parser, quote;
        this.consumeDimensions();
        while (!this.isEof()) {
          character = this.nextCharacter();
          if (character.value === "{" && !quote) {
            this.dimension++;
            if (this.dimension > 1) {
              parser = new _ArrayParser(this.source.substr(this.position - 1), this.transform);
              this.entries.push(parser.parse(true));
              this.position += parser.position - 2;
            }
          } else if (character.value === "}" && !quote) {
            this.dimension--;
            if (!this.dimension) {
              this.newEntry();
              if (nested) return this.entries;
            }
          } else if (character.value === '"' && !character.escaped) {
            if (quote) this.newEntry(true);
            quote = !quote;
          } else if (character.value === "," && !quote) {
            this.newEntry();
          } else {
            this.record(character.value);
          }
        }
        if (this.dimension !== 0) {
          throw new Error("array dimension not balanced");
        }
        return this.entries;
      }
    };
    function identity(value) {
      return value;
    }
    __name(identity, "identity");
  }
});

// node_modules/pg-types/lib/arrayParser.js
var require_arrayParser = __commonJS({
  "node_modules/pg-types/lib/arrayParser.js"(exports, module) {
    var array = require_postgres_array();
    module.exports = {
      create: /* @__PURE__ */ __name(function(source, transform) {
        return {
          parse: /* @__PURE__ */ __name(function() {
            return array.parse(source, transform);
          }, "parse")
        };
      }, "create")
    };
  }
});

// node_modules/postgres-date/index.js
var require_postgres_date = __commonJS({
  "node_modules/postgres-date/index.js"(exports, module) {
    "use strict";
    var DATE_TIME = /(\d{1,})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})(\.\d{1,})?.*?( BC)?$/;
    var DATE = /^(\d{1,})-(\d{2})-(\d{2})( BC)?$/;
    var TIME_ZONE = /([Z+-])(\d{2})?:?(\d{2})?:?(\d{2})?/;
    var INFINITY = /^-?infinity$/;
    module.exports = /* @__PURE__ */ __name(function parseDate(isoDate) {
      if (INFINITY.test(isoDate)) {
        return Number(isoDate.replace("i", "I"));
      }
      var matches = DATE_TIME.exec(isoDate);
      if (!matches) {
        return getDate(isoDate) || null;
      }
      var isBC = !!matches[8];
      var year = parseInt(matches[1], 10);
      if (isBC) {
        year = bcYearToNegativeYear(year);
      }
      var month = parseInt(matches[2], 10) - 1;
      var day = matches[3];
      var hour = parseInt(matches[4], 10);
      var minute = parseInt(matches[5], 10);
      var second = parseInt(matches[6], 10);
      var ms = matches[7];
      ms = ms ? 1e3 * parseFloat(ms) : 0;
      var date;
      var offset = timeZoneOffset(isoDate);
      if (offset != null) {
        date = new Date(Date.UTC(year, month, day, hour, minute, second, ms));
        if (is0To99(year)) {
          date.setUTCFullYear(year);
        }
        if (offset !== 0) {
          date.setTime(date.getTime() - offset);
        }
      } else {
        date = new Date(year, month, day, hour, minute, second, ms);
        if (is0To99(year)) {
          date.setFullYear(year);
        }
      }
      return date;
    }, "parseDate");
    function getDate(isoDate) {
      var matches = DATE.exec(isoDate);
      if (!matches) {
        return;
      }
      var year = parseInt(matches[1], 10);
      var isBC = !!matches[4];
      if (isBC) {
        year = bcYearToNegativeYear(year);
      }
      var month = parseInt(matches[2], 10) - 1;
      var day = matches[3];
      var date = new Date(year, month, day);
      if (is0To99(year)) {
        date.setFullYear(year);
      }
      return date;
    }
    __name(getDate, "getDate");
    function timeZoneOffset(isoDate) {
      if (isoDate.endsWith("+00")) {
        return 0;
      }
      var zone = TIME_ZONE.exec(isoDate.split(" ")[1]);
      if (!zone) return;
      var type = zone[1];
      if (type === "Z") {
        return 0;
      }
      var sign = type === "-" ? -1 : 1;
      var offset = parseInt(zone[2], 10) * 3600 + parseInt(zone[3] || 0, 10) * 60 + parseInt(zone[4] || 0, 10);
      return offset * sign * 1e3;
    }
    __name(timeZoneOffset, "timeZoneOffset");
    function bcYearToNegativeYear(year) {
      return -(year - 1);
    }
    __name(bcYearToNegativeYear, "bcYearToNegativeYear");
    function is0To99(num) {
      return num >= 0 && num < 100;
    }
    __name(is0To99, "is0To99");
  }
});

// node_modules/xtend/mutable.js
var require_mutable = __commonJS({
  "node_modules/xtend/mutable.js"(exports, module) {
    module.exports = extend;
    var hasOwnProperty = Object.prototype.hasOwnProperty;
    function extend(target2) {
      for (var i = 1; i < arguments.length; i++) {
        var source = arguments[i];
        for (var key in source) {
          if (hasOwnProperty.call(source, key)) {
            target2[key] = source[key];
          }
        }
      }
      return target2;
    }
    __name(extend, "extend");
  }
});

// node_modules/postgres-interval/index.js
var require_postgres_interval = __commonJS({
  "node_modules/postgres-interval/index.js"(exports, module) {
    "use strict";
    var extend = require_mutable();
    module.exports = PostgresInterval;
    function PostgresInterval(raw2) {
      if (!(this instanceof PostgresInterval)) {
        return new PostgresInterval(raw2);
      }
      extend(this, parse2(raw2));
    }
    __name(PostgresInterval, "PostgresInterval");
    var properties = ["seconds", "minutes", "hours", "days", "months", "years"];
    PostgresInterval.prototype.toPostgres = function() {
      var filtered = properties.filter(this.hasOwnProperty, this);
      if (this.milliseconds && filtered.indexOf("seconds") < 0) {
        filtered.push("seconds");
      }
      if (filtered.length === 0) return "0";
      return filtered.map(function(property) {
        var value = this[property] || 0;
        if (property === "seconds" && this.milliseconds) {
          value = (value + this.milliseconds / 1e3).toFixed(6).replace(/\.?0+$/, "");
        }
        return value + " " + property;
      }, this).join(" ");
    };
    var propertiesISOEquivalent = {
      years: "Y",
      months: "M",
      days: "D",
      hours: "H",
      minutes: "M",
      seconds: "S"
    };
    var dateProperties = ["years", "months", "days"];
    var timeProperties = ["hours", "minutes", "seconds"];
    PostgresInterval.prototype.toISOString = PostgresInterval.prototype.toISO = function() {
      var datePart = dateProperties.map(buildProperty, this).join("");
      var timePart = timeProperties.map(buildProperty, this).join("");
      return "P" + datePart + "T" + timePart;
      function buildProperty(property) {
        var value = this[property] || 0;
        if (property === "seconds" && this.milliseconds) {
          value = (value + this.milliseconds / 1e3).toFixed(6).replace(/0+$/, "");
        }
        return value + propertiesISOEquivalent[property];
      }
      __name(buildProperty, "buildProperty");
    };
    var NUMBER = "([+-]?\\d+)";
    var YEAR = NUMBER + "\\s+years?";
    var MONTH = NUMBER + "\\s+mons?";
    var DAY = NUMBER + "\\s+days?";
    var TIME = "([+-])?([\\d]*):(\\d\\d):(\\d\\d)\\.?(\\d{1,6})?";
    var INTERVAL = new RegExp([YEAR, MONTH, DAY, TIME].map(function(regexString) {
      return "(" + regexString + ")?";
    }).join("\\s*"));
    var positions = {
      years: 2,
      months: 4,
      days: 6,
      hours: 9,
      minutes: 10,
      seconds: 11,
      milliseconds: 12
    };
    var negatives = ["hours", "minutes", "seconds", "milliseconds"];
    function parseMilliseconds(fraction) {
      var microseconds = fraction + "000000".slice(fraction.length);
      return parseInt(microseconds, 10) / 1e3;
    }
    __name(parseMilliseconds, "parseMilliseconds");
    function parse2(interval) {
      if (!interval) return {};
      var matches = INTERVAL.exec(interval);
      var isNegative = matches[8] === "-";
      return Object.keys(positions).reduce(function(parsed, property) {
        var position = positions[property];
        var value = matches[position];
        if (!value) return parsed;
        value = property === "milliseconds" ? parseMilliseconds(value) : parseInt(value, 10);
        if (!value) return parsed;
        if (isNegative && ~negatives.indexOf(property)) {
          value *= -1;
        }
        parsed[property] = value;
        return parsed;
      }, {});
    }
    __name(parse2, "parse");
  }
});

// node_modules/postgres-bytea/index.js
var require_postgres_bytea = __commonJS({
  "node_modules/postgres-bytea/index.js"(exports, module) {
    "use strict";
    var bufferFrom = Buffer.from || Buffer;
    module.exports = /* @__PURE__ */ __name(function parseBytea(input) {
      if (/^\\x/.test(input)) {
        return bufferFrom(input.substr(2), "hex");
      }
      var output = "";
      var i = 0;
      while (i < input.length) {
        if (input[i] !== "\\") {
          output += input[i];
          ++i;
        } else {
          if (/[0-7]{3}/.test(input.substr(i + 1, 3))) {
            output += String.fromCharCode(parseInt(input.substr(i + 1, 3), 8));
            i += 4;
          } else {
            var backslashes = 1;
            while (i + backslashes < input.length && input[i + backslashes] === "\\") {
              backslashes++;
            }
            for (var k = 0; k < Math.floor(backslashes / 2); ++k) {
              output += "\\";
            }
            i += Math.floor(backslashes / 2) * 2;
          }
        }
      }
      return bufferFrom(output, "binary");
    }, "parseBytea");
  }
});

// node_modules/pg-types/lib/textParsers.js
var require_textParsers = __commonJS({
  "node_modules/pg-types/lib/textParsers.js"(exports, module) {
    var array = require_postgres_array();
    var arrayParser = require_arrayParser();
    var parseDate = require_postgres_date();
    var parseInterval = require_postgres_interval();
    var parseByteA = require_postgres_bytea();
    function allowNull(fn) {
      return /* @__PURE__ */ __name(function nullAllowed(value) {
        if (value === null) return value;
        return fn(value);
      }, "nullAllowed");
    }
    __name(allowNull, "allowNull");
    function parseBool(value) {
      if (value === null) return value;
      return value === "TRUE" || value === "t" || value === "true" || value === "y" || value === "yes" || value === "on" || value === "1";
    }
    __name(parseBool, "parseBool");
    function parseBoolArray(value) {
      if (!value) return null;
      return array.parse(value, parseBool);
    }
    __name(parseBoolArray, "parseBoolArray");
    function parseBaseTenInt(string) {
      return parseInt(string, 10);
    }
    __name(parseBaseTenInt, "parseBaseTenInt");
    function parseIntegerArray(value) {
      if (!value) return null;
      return array.parse(value, allowNull(parseBaseTenInt));
    }
    __name(parseIntegerArray, "parseIntegerArray");
    function parseBigIntegerArray(value) {
      if (!value) return null;
      return array.parse(value, allowNull(function(entry) {
        return parseBigInteger(entry).trim();
      }));
    }
    __name(parseBigIntegerArray, "parseBigIntegerArray");
    var parsePointArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      var p = arrayParser.create(value, function(entry) {
        if (entry !== null) {
          entry = parsePoint(entry);
        }
        return entry;
      });
      return p.parse();
    }, "parsePointArray");
    var parseFloatArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      var p = arrayParser.create(value, function(entry) {
        if (entry !== null) {
          entry = parseFloat(entry);
        }
        return entry;
      });
      return p.parse();
    }, "parseFloatArray");
    var parseStringArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      var p = arrayParser.create(value);
      return p.parse();
    }, "parseStringArray");
    var parseDateArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      var p = arrayParser.create(value, function(entry) {
        if (entry !== null) {
          entry = parseDate(entry);
        }
        return entry;
      });
      return p.parse();
    }, "parseDateArray");
    var parseIntervalArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      var p = arrayParser.create(value, function(entry) {
        if (entry !== null) {
          entry = parseInterval(entry);
        }
        return entry;
      });
      return p.parse();
    }, "parseIntervalArray");
    var parseByteAArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      return array.parse(value, allowNull(parseByteA));
    }, "parseByteAArray");
    var parseInteger = /* @__PURE__ */ __name(function(value) {
      return parseInt(value, 10);
    }, "parseInteger");
    var parseBigInteger = /* @__PURE__ */ __name(function(value) {
      var valStr = String(value);
      if (/^\d+$/.test(valStr)) {
        return valStr;
      }
      return value;
    }, "parseBigInteger");
    var parseJsonArray = /* @__PURE__ */ __name(function(value) {
      if (!value) {
        return null;
      }
      return array.parse(value, allowNull(JSON.parse));
    }, "parseJsonArray");
    var parsePoint = /* @__PURE__ */ __name(function(value) {
      if (value[0] !== "(") {
        return null;
      }
      value = value.substring(1, value.length - 1).split(",");
      return {
        x: parseFloat(value[0]),
        y: parseFloat(value[1])
      };
    }, "parsePoint");
    var parseCircle = /* @__PURE__ */ __name(function(value) {
      if (value[0] !== "<" && value[1] !== "(") {
        return null;
      }
      var point = "(";
      var radius = "";
      var pointParsed = false;
      for (var i = 2; i < value.length - 1; i++) {
        if (!pointParsed) {
          point += value[i];
        }
        if (value[i] === ")") {
          pointParsed = true;
          continue;
        } else if (!pointParsed) {
          continue;
        }
        if (value[i] === ",") {
          continue;
        }
        radius += value[i];
      }
      var result = parsePoint(point);
      result.radius = parseFloat(radius);
      return result;
    }, "parseCircle");
    var init = /* @__PURE__ */ __name(function(register) {
      register(20, parseBigInteger);
      register(21, parseInteger);
      register(23, parseInteger);
      register(26, parseInteger);
      register(700, parseFloat);
      register(701, parseFloat);
      register(16, parseBool);
      register(1082, parseDate);
      register(1114, parseDate);
      register(1184, parseDate);
      register(600, parsePoint);
      register(651, parseStringArray);
      register(718, parseCircle);
      register(1e3, parseBoolArray);
      register(1001, parseByteAArray);
      register(1005, parseIntegerArray);
      register(1007, parseIntegerArray);
      register(1028, parseIntegerArray);
      register(1016, parseBigIntegerArray);
      register(1017, parsePointArray);
      register(1021, parseFloatArray);
      register(1022, parseFloatArray);
      register(1231, parseFloatArray);
      register(1014, parseStringArray);
      register(1015, parseStringArray);
      register(1008, parseStringArray);
      register(1009, parseStringArray);
      register(1040, parseStringArray);
      register(1041, parseStringArray);
      register(1115, parseDateArray);
      register(1182, parseDateArray);
      register(1185, parseDateArray);
      register(1186, parseInterval);
      register(1187, parseIntervalArray);
      register(17, parseByteA);
      register(114, JSON.parse.bind(JSON));
      register(3802, JSON.parse.bind(JSON));
      register(199, parseJsonArray);
      register(3807, parseJsonArray);
      register(3907, parseStringArray);
      register(2951, parseStringArray);
      register(791, parseStringArray);
      register(1183, parseStringArray);
      register(1270, parseStringArray);
    }, "init");
    module.exports = {
      init
    };
  }
});

// node_modules/pg-int8/index.js
var require_pg_int8 = __commonJS({
  "node_modules/pg-int8/index.js"(exports, module) {
    "use strict";
    var BASE = 1e6;
    function readInt8(buffer) {
      var high = buffer.readInt32BE(0);
      var low = buffer.readUInt32BE(4);
      var sign = "";
      if (high < 0) {
        high = ~high + (low === 0);
        low = ~low + 1 >>> 0;
        sign = "-";
      }
      var result = "";
      var carry;
      var t;
      var digits;
      var pad;
      var l;
      var i;
      {
        carry = high % BASE;
        high = high / BASE >>> 0;
        t = 4294967296 * carry + low;
        low = t / BASE >>> 0;
        digits = "" + (t - BASE * low);
        if (low === 0 && high === 0) {
          return sign + digits + result;
        }
        pad = "";
        l = 6 - digits.length;
        for (i = 0; i < l; i++) {
          pad += "0";
        }
        result = pad + digits + result;
      }
      {
        carry = high % BASE;
        high = high / BASE >>> 0;
        t = 4294967296 * carry + low;
        low = t / BASE >>> 0;
        digits = "" + (t - BASE * low);
        if (low === 0 && high === 0) {
          return sign + digits + result;
        }
        pad = "";
        l = 6 - digits.length;
        for (i = 0; i < l; i++) {
          pad += "0";
        }
        result = pad + digits + result;
      }
      {
        carry = high % BASE;
        high = high / BASE >>> 0;
        t = 4294967296 * carry + low;
        low = t / BASE >>> 0;
        digits = "" + (t - BASE * low);
        if (low === 0 && high === 0) {
          return sign + digits + result;
        }
        pad = "";
        l = 6 - digits.length;
        for (i = 0; i < l; i++) {
          pad += "0";
        }
        result = pad + digits + result;
      }
      {
        carry = high % BASE;
        t = 4294967296 * carry + low;
        digits = "" + t % BASE;
        return sign + digits + result;
      }
    }
    __name(readInt8, "readInt8");
    module.exports = readInt8;
  }
});

// node_modules/pg-types/lib/binaryParsers.js
var require_binaryParsers = __commonJS({
  "node_modules/pg-types/lib/binaryParsers.js"(exports, module) {
    var parseInt64 = require_pg_int8();
    var parseBits = /* @__PURE__ */ __name(function(data, bits, offset, invert, callback) {
      offset = offset || 0;
      invert = invert || false;
      callback = callback || function(lastValue, newValue, bits2) {
        return lastValue * Math.pow(2, bits2) + newValue;
      };
      var offsetBytes = offset >> 3;
      var inv = /* @__PURE__ */ __name(function(value) {
        if (invert) {
          return ~value & 255;
        }
        return value;
      }, "inv");
      var mask = 255;
      var firstBits = 8 - offset % 8;
      if (bits < firstBits) {
        mask = 255 << 8 - bits & 255;
        firstBits = bits;
      }
      if (offset) {
        mask = mask >> offset % 8;
      }
      var result = 0;
      if (offset % 8 + bits >= 8) {
        result = callback(0, inv(data[offsetBytes]) & mask, firstBits);
      }
      var bytes = bits + offset >> 3;
      for (var i = offsetBytes + 1; i < bytes; i++) {
        result = callback(result, inv(data[i]), 8);
      }
      var lastBits = (bits + offset) % 8;
      if (lastBits > 0) {
        result = callback(result, inv(data[bytes]) >> 8 - lastBits, lastBits);
      }
      return result;
    }, "parseBits");
    var parseFloatFromBits = /* @__PURE__ */ __name(function(data, precisionBits, exponentBits) {
      var bias = Math.pow(2, exponentBits - 1) - 1;
      var sign = parseBits(data, 1);
      var exponent = parseBits(data, exponentBits, 1);
      if (exponent === 0) {
        return 0;
      }
      var precisionBitsCounter = 1;
      var parsePrecisionBits = /* @__PURE__ */ __name(function(lastValue, newValue, bits) {
        if (lastValue === 0) {
          lastValue = 1;
        }
        for (var i = 1; i <= bits; i++) {
          precisionBitsCounter /= 2;
          if ((newValue & 1 << bits - i) > 0) {
            lastValue += precisionBitsCounter;
          }
        }
        return lastValue;
      }, "parsePrecisionBits");
      var mantissa = parseBits(data, precisionBits, exponentBits + 1, false, parsePrecisionBits);
      if (exponent == Math.pow(2, exponentBits + 1) - 1) {
        if (mantissa === 0) {
          return sign === 0 ? Infinity : -Infinity;
        }
        return NaN;
      }
      return (sign === 0 ? 1 : -1) * Math.pow(2, exponent - bias) * mantissa;
    }, "parseFloatFromBits");
    var parseInt16 = /* @__PURE__ */ __name(function(value) {
      if (parseBits(value, 1) == 1) {
        return -1 * (parseBits(value, 15, 1, true) + 1);
      }
      return parseBits(value, 15, 1);
    }, "parseInt16");
    var parseInt32 = /* @__PURE__ */ __name(function(value) {
      if (parseBits(value, 1) == 1) {
        return -1 * (parseBits(value, 31, 1, true) + 1);
      }
      return parseBits(value, 31, 1);
    }, "parseInt32");
    var parseFloat32 = /* @__PURE__ */ __name(function(value) {
      return parseFloatFromBits(value, 23, 8);
    }, "parseFloat32");
    var parseFloat64 = /* @__PURE__ */ __name(function(value) {
      return parseFloatFromBits(value, 52, 11);
    }, "parseFloat64");
    var parseNumeric = /* @__PURE__ */ __name(function(value) {
      var sign = parseBits(value, 16, 32);
      if (sign == 49152) {
        return NaN;
      }
      var weight = Math.pow(1e4, parseBits(value, 16, 16));
      var result = 0;
      var digits = [];
      var ndigits = parseBits(value, 16);
      for (var i = 0; i < ndigits; i++) {
        result += parseBits(value, 16, 64 + 16 * i) * weight;
        weight /= 1e4;
      }
      var scale = Math.pow(10, parseBits(value, 16, 48));
      return (sign === 0 ? 1 : -1) * Math.round(result * scale) / scale;
    }, "parseNumeric");
    var parseDate = /* @__PURE__ */ __name(function(isUTC, value) {
      var sign = parseBits(value, 1);
      var rawValue = parseBits(value, 63, 1);
      var result = new Date((sign === 0 ? 1 : -1) * rawValue / 1e3 + 9466848e5);
      if (!isUTC) {
        result.setTime(result.getTime() + result.getTimezoneOffset() * 6e4);
      }
      result.usec = rawValue % 1e3;
      result.getMicroSeconds = function() {
        return this.usec;
      };
      result.setMicroSeconds = function(value2) {
        this.usec = value2;
      };
      result.getUTCMicroSeconds = function() {
        return this.usec;
      };
      return result;
    }, "parseDate");
    var parseArray = /* @__PURE__ */ __name(function(value) {
      var dim = parseBits(value, 32);
      var flags = parseBits(value, 32, 32);
      var elementType = parseBits(value, 32, 64);
      var offset = 96;
      var dims = [];
      for (var i = 0; i < dim; i++) {
        dims[i] = parseBits(value, 32, offset);
        offset += 32;
        offset += 32;
      }
      var parseElement = /* @__PURE__ */ __name(function(elementType2) {
        var length = parseBits(value, 32, offset);
        offset += 32;
        if (length == 4294967295) {
          return null;
        }
        var result;
        if (elementType2 == 23 || elementType2 == 20) {
          result = parseBits(value, length * 8, offset);
          offset += length * 8;
          return result;
        } else if (elementType2 == 25) {
          result = value.toString(this.encoding, offset >> 3, (offset += length << 3) >> 3);
          return result;
        } else {
          console.log("ERROR: ElementType not implemented: " + elementType2);
        }
      }, "parseElement");
      var parse2 = /* @__PURE__ */ __name(function(dimension, elementType2) {
        var array = [];
        var i2;
        if (dimension.length > 1) {
          var count = dimension.shift();
          for (i2 = 0; i2 < count; i2++) {
            array[i2] = parse2(dimension, elementType2);
          }
          dimension.unshift(count);
        } else {
          for (i2 = 0; i2 < dimension[0]; i2++) {
            array[i2] = parseElement(elementType2);
          }
        }
        return array;
      }, "parse");
      return parse2(dims, elementType);
    }, "parseArray");
    var parseText = /* @__PURE__ */ __name(function(value) {
      return value.toString("utf8");
    }, "parseText");
    var parseBool = /* @__PURE__ */ __name(function(value) {
      if (value === null) return null;
      return parseBits(value, 8) > 0;
    }, "parseBool");
    var init = /* @__PURE__ */ __name(function(register) {
      register(20, parseInt64);
      register(21, parseInt16);
      register(23, parseInt32);
      register(26, parseInt32);
      register(1700, parseNumeric);
      register(700, parseFloat32);
      register(701, parseFloat64);
      register(16, parseBool);
      register(1114, parseDate.bind(null, false));
      register(1184, parseDate.bind(null, true));
      register(1e3, parseArray);
      register(1007, parseArray);
      register(1016, parseArray);
      register(1008, parseArray);
      register(1009, parseArray);
      register(25, parseText);
    }, "init");
    module.exports = {
      init
    };
  }
});

// node_modules/pg-types/lib/builtins.js
var require_builtins = __commonJS({
  "node_modules/pg-types/lib/builtins.js"(exports, module) {
    module.exports = {
      BOOL: 16,
      BYTEA: 17,
      CHAR: 18,
      INT8: 20,
      INT2: 21,
      INT4: 23,
      REGPROC: 24,
      TEXT: 25,
      OID: 26,
      TID: 27,
      XID: 28,
      CID: 29,
      JSON: 114,
      XML: 142,
      PG_NODE_TREE: 194,
      SMGR: 210,
      PATH: 602,
      POLYGON: 604,
      CIDR: 650,
      FLOAT4: 700,
      FLOAT8: 701,
      ABSTIME: 702,
      RELTIME: 703,
      TINTERVAL: 704,
      CIRCLE: 718,
      MACADDR8: 774,
      MONEY: 790,
      MACADDR: 829,
      INET: 869,
      ACLITEM: 1033,
      BPCHAR: 1042,
      VARCHAR: 1043,
      DATE: 1082,
      TIME: 1083,
      TIMESTAMP: 1114,
      TIMESTAMPTZ: 1184,
      INTERVAL: 1186,
      TIMETZ: 1266,
      BIT: 1560,
      VARBIT: 1562,
      NUMERIC: 1700,
      REFCURSOR: 1790,
      REGPROCEDURE: 2202,
      REGOPER: 2203,
      REGOPERATOR: 2204,
      REGCLASS: 2205,
      REGTYPE: 2206,
      UUID: 2950,
      TXID_SNAPSHOT: 2970,
      PG_LSN: 3220,
      PG_NDISTINCT: 3361,
      PG_DEPENDENCIES: 3402,
      TSVECTOR: 3614,
      TSQUERY: 3615,
      GTSVECTOR: 3642,
      REGCONFIG: 3734,
      REGDICTIONARY: 3769,
      JSONB: 3802,
      REGNAMESPACE: 4089,
      REGROLE: 4096
    };
  }
});

// node_modules/pg-types/index.js
var require_pg_types = __commonJS({
  "node_modules/pg-types/index.js"(exports) {
    var textParsers = require_textParsers();
    var binaryParsers = require_binaryParsers();
    var arrayParser = require_arrayParser();
    var builtinTypes = require_builtins();
    exports.getTypeParser = getTypeParser;
    exports.setTypeParser = setTypeParser;
    exports.arrayParser = arrayParser;
    exports.builtins = builtinTypes;
    var typeParsers = {
      text: {},
      binary: {}
    };
    function noParse(val) {
      return String(val);
    }
    __name(noParse, "noParse");
    function getTypeParser(oid, format) {
      format = format || "text";
      if (!typeParsers[format]) {
        return noParse;
      }
      return typeParsers[format][oid] || noParse;
    }
    __name(getTypeParser, "getTypeParser");
    function setTypeParser(oid, format, parseFn) {
      if (typeof format == "function") {
        parseFn = format;
        format = "text";
      }
      typeParsers[format][oid] = parseFn;
    }
    __name(setTypeParser, "setTypeParser");
    textParsers.init(function(oid, converter) {
      typeParsers.text[oid] = converter;
    });
    binaryParsers.init(function(oid, converter) {
      typeParsers.binary[oid] = converter;
    });
  }
});

// node_modules/pg/lib/defaults.js
var require_defaults = __commonJS({
  "node_modules/pg/lib/defaults.js"(exports, module) {
    "use strict";
    var user2;
    try {
      user2 = process.platform === "win32" ? process.env.USERNAME : process.env.USER;
    } catch {
    }
    module.exports = {
      // database host. defaults to localhost
      host: "localhost",
      // database user's name
      user: user2,
      // name of database to connect
      database: void 0,
      // database user's password
      password: null,
      // a Postgres connection string to be used instead of setting individual connection items
      // NOTE:  Setting this value will cause it to override any other value (such as database or user) defined
      // in the defaults object.
      connectionString: void 0,
      // database port
      port: 5432,
      // number of rows to return at a time from a prepared statement's
      // portal. 0 will return all rows at once
      rows: 0,
      // binary result mode
      binary: false,
      // Connection pool options - see https://github.com/brianc/node-pg-pool
      // number of connections to use in connection pool
      // 0 will disable connection pooling
      max: 10,
      // max milliseconds a client can go unused before it is removed
      // from the pool and destroyed
      idleTimeoutMillis: 3e4,
      client_encoding: "",
      ssl: false,
      // SSL negotiation style: 'postgres' (traditional SSLRequest) or 'direct'
      sslnegotiation: void 0,
      application_name: void 0,
      fallback_application_name: void 0,
      options: void 0,
      parseInputDatesAsUTC: false,
      // max milliseconds any query using this connection will execute for before timing out in error.
      // false=unlimited
      statement_timeout: false,
      // Abort any statement that waits longer than the specified duration in milliseconds while attempting to acquire a lock.
      // false=unlimited
      lock_timeout: false,
      // Terminate any session with an open transaction that has been idle for longer than the specified duration in milliseconds
      // false=unlimited
      idle_in_transaction_session_timeout: false,
      // max milliseconds to wait for query to complete (client side)
      query_timeout: false,
      connect_timeout: 0,
      keepalives: 1,
      keepalives_idle: 0
    };
    var pgTypes = require_pg_types();
    var parseBigInteger = pgTypes.getTypeParser(20, "text");
    var parseBigIntegerArray = pgTypes.getTypeParser(1016, "text");
    module.exports.__defineSetter__("parseInt8", function(val) {
      pgTypes.setTypeParser(20, "text", val ? pgTypes.getTypeParser(23, "text") : parseBigInteger);
      pgTypes.setTypeParser(1016, "text", val ? pgTypes.getTypeParser(1007, "text") : parseBigIntegerArray);
    });
  }
});

// node-built-in-modules:util/types
import libDefault2 from "util/types";
var require_types = __commonJS({
  "node-built-in-modules:util/types"(exports, module) {
    module.exports = libDefault2;
  }
});

// node_modules/pg/lib/utils.js
var require_utils = __commonJS({
  "node_modules/pg/lib/utils.js"(exports, module) {
    "use strict";
    var defaults2 = require_defaults();
    var { isDate } = require_types();
    function escapeElement(elementRepresentation) {
      const escaped = elementRepresentation.replace(/\\/g, "\\\\").replace(/"/g, '\\"');
      return '"' + escaped + '"';
    }
    __name(escapeElement, "escapeElement");
    function arrayString(val) {
      let result = "{";
      for (let i = 0; i < val.length; i++) {
        if (i > 0) {
          result += ",";
        }
        let item = val[i];
        if (item == null) {
          result += "NULL";
        } else if (Array.isArray(item)) {
          result += arrayString(item);
        } else if (ArrayBuffer.isView(item)) {
          if (!(item instanceof Buffer)) {
            item = Buffer.from(item.buffer, item.byteOffset, item.byteLength);
          }
          result += "\\\\x" + item.toString("hex");
        } else {
          result += escapeElement(prepareValue(item));
        }
      }
      result += "}";
      return result;
    }
    __name(arrayString, "arrayString");
    var prepareValue = /* @__PURE__ */ __name(function(val, seen) {
      if (val == null) {
        return null;
      }
      if (typeof val === "object") {
        if (val instanceof Buffer) {
          return val;
        }
        if (ArrayBuffer.isView(val)) {
          return Buffer.from(val.buffer, val.byteOffset, val.byteLength);
        }
        if (isDate(val)) {
          if (defaults2.parseInputDatesAsUTC) {
            return dateToStringUTC(val);
          } else {
            return dateToString(val);
          }
        }
        if (Array.isArray(val)) {
          return arrayString(val);
        }
        return prepareObject(val, seen);
      }
      return val.toString();
    }, "prepareValue");
    function prepareObject(val, seen) {
      if (val && typeof val.toPostgres === "function") {
        seen = seen || [];
        if (seen.indexOf(val) !== -1) {
          throw new Error('circular reference detected while preparing "' + val + '" for query');
        }
        seen.push(val);
        return prepareValue(val.toPostgres(prepareValue), seen);
      }
      return JSON.stringify(val);
    }
    __name(prepareObject, "prepareObject");
    function dateToString(date) {
      let offset = -date.getTimezoneOffset();
      let year = date.getFullYear();
      const isBCYear = year < 1;
      if (isBCYear) year = Math.abs(year) + 1;
      let ret = String(year).padStart(4, "0") + "-" + String(date.getMonth() + 1).padStart(2, "0") + "-" + String(date.getDate()).padStart(2, "0") + "T" + String(date.getHours()).padStart(2, "0") + ":" + String(date.getMinutes()).padStart(2, "0") + ":" + String(date.getSeconds()).padStart(2, "0") + "." + String(date.getMilliseconds()).padStart(3, "0");
      if (offset < 0) {
        ret += "-";
        offset *= -1;
      } else {
        ret += "+";
      }
      ret += String(Math.floor(offset / 60)).padStart(2, "0") + ":" + String(offset % 60).padStart(2, "0");
      if (isBCYear) ret += " BC";
      return ret;
    }
    __name(dateToString, "dateToString");
    function dateToStringUTC(date) {
      let year = date.getUTCFullYear();
      const isBCYear = year < 1;
      if (isBCYear) year = Math.abs(year) + 1;
      let ret = String(year).padStart(4, "0") + "-" + String(date.getUTCMonth() + 1).padStart(2, "0") + "-" + String(date.getUTCDate()).padStart(2, "0") + "T" + String(date.getUTCHours()).padStart(2, "0") + ":" + String(date.getUTCMinutes()).padStart(2, "0") + ":" + String(date.getUTCSeconds()).padStart(2, "0") + "." + String(date.getUTCMilliseconds()).padStart(3, "0");
      ret += "+00:00";
      if (isBCYear) ret += " BC";
      return ret;
    }
    __name(dateToStringUTC, "dateToStringUTC");
    function normalizeQueryConfig(config, values, callback) {
      config = typeof config === "string" ? { text: config } : config;
      if (values) {
        if (typeof values === "function") {
          config.callback = values;
        } else {
          config.values = values;
        }
      }
      if (callback) {
        config.callback = callback;
      }
      return config;
    }
    __name(normalizeQueryConfig, "normalizeQueryConfig");
    var escapeIdentifier2 = /* @__PURE__ */ __name(function(str) {
      return '"' + str.replace(/"/g, '""') + '"';
    }, "escapeIdentifier");
    var escapeLiteral2 = /* @__PURE__ */ __name(function(str) {
      let hasBackslash = false;
      let escaped = "'";
      if (str == null) {
        return "''";
      }
      if (typeof str !== "string") {
        return "''";
      }
      for (let i = 0; i < str.length; i++) {
        const c = str[i];
        if (c === "'") {
          escaped += c + c;
        } else if (c === "\\") {
          escaped += c + c;
          hasBackslash = true;
        } else {
          escaped += c;
        }
      }
      escaped += "'";
      if (hasBackslash === true) {
        escaped = " E" + escaped;
      }
      return escaped;
    }, "escapeLiteral");
    module.exports = {
      prepareValue: /* @__PURE__ */ __name(function prepareValueWrapper(value) {
        return prepareValue(value);
      }, "prepareValueWrapper"),
      normalizeQueryConfig,
      escapeIdentifier: escapeIdentifier2,
      escapeLiteral: escapeLiteral2
    };
  }
});

// node-built-in-modules:util
import libDefault3 from "util";
var require_util = __commonJS({
  "node-built-in-modules:util"(exports, module) {
    module.exports = libDefault3;
  }
});

// node-built-in-modules:crypto
import libDefault4 from "crypto";
var require_crypto = __commonJS({
  "node-built-in-modules:crypto"(exports, module) {
    module.exports = libDefault4;
  }
});

// node_modules/pg/lib/crypto/utils.js
var require_utils2 = __commonJS({
  "node_modules/pg/lib/crypto/utils.js"(exports, module) {
    var nodeCrypto = require_crypto();
    module.exports = {
      postgresMd5PasswordHash,
      randomBytes,
      deriveKey,
      sha256: sha2562,
      hashByName,
      hmacSha256,
      md5
    };
    var webCrypto = nodeCrypto.webcrypto || globalThis.crypto;
    var subtleCrypto = webCrypto.subtle;
    var textEncoder = new TextEncoder();
    function randomBytes(length) {
      return webCrypto.getRandomValues(Buffer.alloc(length));
    }
    __name(randomBytes, "randomBytes");
    async function md5(string) {
      try {
        return nodeCrypto.createHash("md5").update(string, "utf-8").digest("hex");
      } catch (e) {
        const data = typeof string === "string" ? textEncoder.encode(string) : string;
        const hash = await subtleCrypto.digest("MD5", data);
        return Array.from(new Uint8Array(hash)).map((b) => b.toString(16).padStart(2, "0")).join("");
      }
    }
    __name(md5, "md5");
    async function postgresMd5PasswordHash(user2, password, salt) {
      const inner = await md5(password + user2);
      const outer = await md5(Buffer.concat([Buffer.from(inner), salt]));
      return "md5" + outer;
    }
    __name(postgresMd5PasswordHash, "postgresMd5PasswordHash");
    async function sha2562(text2) {
      return await subtleCrypto.digest("SHA-256", text2);
    }
    __name(sha2562, "sha256");
    async function hashByName(hashName, text2) {
      return await subtleCrypto.digest(hashName, text2);
    }
    __name(hashByName, "hashByName");
    async function hmacSha256(keyBuffer, msg) {
      const key = await subtleCrypto.importKey("raw", keyBuffer, { name: "HMAC", hash: "SHA-256" }, false, ["sign"]);
      return await subtleCrypto.sign("HMAC", key, textEncoder.encode(msg));
    }
    __name(hmacSha256, "hmacSha256");
    async function deriveKey(password, salt, iterations) {
      const key = await subtleCrypto.importKey("raw", textEncoder.encode(password), "PBKDF2", false, ["deriveBits"]);
      const params = { name: "PBKDF2", hash: "SHA-256", salt, iterations };
      return await subtleCrypto.deriveBits(params, key, 32 * 8, ["deriveBits"]);
    }
    __name(deriveKey, "deriveKey");
  }
});

// node_modules/pg/lib/crypto/cert-signatures.js
var require_cert_signatures = __commonJS({
  "node_modules/pg/lib/crypto/cert-signatures.js"(exports, module) {
    function x509Error(msg, cert) {
      return new Error("SASL channel binding: " + msg + " when parsing public certificate " + cert.toString("base64"));
    }
    __name(x509Error, "x509Error");
    function readASN1Length(data, index) {
      let length = data[index++];
      if (length < 128) return { length, index };
      const lengthBytes = length & 127;
      if (lengthBytes > 4) throw x509Error("bad length", data);
      length = 0;
      for (let i = 0; i < lengthBytes; i++) {
        length = length << 8 | data[index++];
      }
      return { length, index };
    }
    __name(readASN1Length, "readASN1Length");
    function readASN1OID(data, index) {
      if (data[index++] !== 6) throw x509Error("non-OID data", data);
      const { length: OIDLength, index: indexAfterOIDLength } = readASN1Length(data, index);
      index = indexAfterOIDLength;
      const lastIndex = index + OIDLength;
      const byte1 = data[index++];
      let oid = (byte1 / 40 >> 0) + "." + byte1 % 40;
      while (index < lastIndex) {
        let value = 0;
        while (index < lastIndex) {
          const nextByte = data[index++];
          value = value << 7 | nextByte & 127;
          if (nextByte < 128) break;
        }
        oid += "." + value;
      }
      return { oid, index };
    }
    __name(readASN1OID, "readASN1OID");
    function expectASN1Seq(data, index) {
      if (data[index++] !== 48) throw x509Error("non-sequence data", data);
      return readASN1Length(data, index);
    }
    __name(expectASN1Seq, "expectASN1Seq");
    function signatureAlgorithmHashFromCertificate(data, index) {
      if (index === void 0) index = 0;
      index = expectASN1Seq(data, index).index;
      const { length: certInfoLength, index: indexAfterCertInfoLength } = expectASN1Seq(data, index);
      index = indexAfterCertInfoLength + certInfoLength;
      index = expectASN1Seq(data, index).index;
      const { oid, index: indexAfterOID } = readASN1OID(data, index);
      switch (oid) {
        // RSA
        case "1.2.840.113549.1.1.4":
          return "MD5";
        case "1.2.840.113549.1.1.5":
          return "SHA-1";
        case "1.2.840.113549.1.1.11":
          return "SHA-256";
        case "1.2.840.113549.1.1.12":
          return "SHA-384";
        case "1.2.840.113549.1.1.13":
          return "SHA-512";
        case "1.2.840.113549.1.1.14":
          return "SHA-224";
        case "1.2.840.113549.1.1.15":
          return "SHA512-224";
        case "1.2.840.113549.1.1.16":
          return "SHA512-256";
        // ECDSA
        case "1.2.840.10045.4.1":
          return "SHA-1";
        case "1.2.840.10045.4.3.1":
          return "SHA-224";
        case "1.2.840.10045.4.3.2":
          return "SHA-256";
        case "1.2.840.10045.4.3.3":
          return "SHA-384";
        case "1.2.840.10045.4.3.4":
          return "SHA-512";
        // RSASSA-PSS: hash is indicated separately
        case "1.2.840.113549.1.1.10": {
          index = indexAfterOID;
          index = expectASN1Seq(data, index).index;
          if (data[index++] !== 160) throw x509Error("non-tag data", data);
          index = readASN1Length(data, index).index;
          index = expectASN1Seq(data, index).index;
          const { oid: hashOID } = readASN1OID(data, index);
          switch (hashOID) {
            // standalone hash OIDs
            case "1.2.840.113549.2.5":
              return "MD5";
            case "1.3.14.3.2.26":
              return "SHA-1";
            case "2.16.840.1.101.3.4.2.1":
              return "SHA-256";
            case "2.16.840.1.101.3.4.2.2":
              return "SHA-384";
            case "2.16.840.1.101.3.4.2.3":
              return "SHA-512";
          }
          throw x509Error("unknown hash OID " + hashOID, data);
        }
        // Ed25519 -- see https: return//github.com/openssl/openssl/issues/15477
        case "1.3.101.110":
        case "1.3.101.112":
          return "SHA-512";
        // Ed448 -- still not in pg 17.2 (if supported, digest would be SHAKE256 x 64 bytes)
        case "1.3.101.111":
        case "1.3.101.113":
          throw x509Error("Ed448 certificate channel binding is not currently supported by Postgres");
      }
      throw x509Error("unknown OID " + oid, data);
    }
    __name(signatureAlgorithmHashFromCertificate, "signatureAlgorithmHashFromCertificate");
    module.exports = { signatureAlgorithmHashFromCertificate };
  }
});

// node_modules/pg/lib/crypto/sasl.js
var require_sasl = __commonJS({
  "node_modules/pg/lib/crypto/sasl.js"(exports, module) {
    "use strict";
    var crypto2 = require_utils2();
    var { signatureAlgorithmHashFromCertificate } = require_cert_signatures();
    function saslprep(password) {
      const nonAsciiSpace = /[\u00A0\u1680\u2000-\u200B\u202F\u205F\u3000]/g;
      const mappedToNothing = /[\u00AD\u034F\u1806\u180B\u180C\u180D\u200C\u200D\u2060\uFE00-\uFE0F\uFEFF]/g;
      return password.replace(nonAsciiSpace, " ").replace(mappedToNothing, "").normalize("NFKC");
    }
    __name(saslprep, "saslprep");
    var DEFAULT_MAX_SCRAM_ITERATIONS = 1e5;
    function startSession(mechanisms, stream, scramMaxIterations = DEFAULT_MAX_SCRAM_ITERATIONS) {
      const candidates = ["SCRAM-SHA-256"];
      if (stream) candidates.unshift("SCRAM-SHA-256-PLUS");
      const mechanism = candidates.find((candidate) => mechanisms.includes(candidate));
      if (!mechanism) {
        throw new Error("SASL: Only mechanism(s) " + candidates.join(" and ") + " are supported");
      }
      if (mechanism === "SCRAM-SHA-256-PLUS" && typeof stream.getPeerCertificate !== "function") {
        throw new Error("SASL: Mechanism SCRAM-SHA-256-PLUS requires a certificate");
      }
      const clientNonce = crypto2.randomBytes(18).toString("base64");
      const gs2Header = mechanism === "SCRAM-SHA-256-PLUS" ? "p=tls-server-end-point" : stream ? "y" : "n";
      return {
        mechanism,
        clientNonce,
        response: gs2Header + ",,n=*,r=" + clientNonce,
        message: "SASLInitialResponse",
        scramMaxIterations
      };
    }
    __name(startSession, "startSession");
    async function continueSession(session, password, serverData, stream) {
      if (session.message !== "SASLInitialResponse") {
        throw new Error("SASL: Last message was not SASLInitialResponse");
      }
      if (typeof password !== "string") {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: client password must be a string");
      }
      if (password === "") {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: client password must be a non-empty string");
      }
      if (typeof serverData !== "string") {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: serverData must be a string");
      }
      const sv = parseServerFirstMessage(serverData);
      if (!sv.nonce.startsWith(session.clientNonce)) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: server nonce does not start with client nonce");
      } else if (sv.nonce.length === session.clientNonce.length) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: server nonce is too short");
      }
      const scramMaxIterations = typeof session.scramMaxIterations === "number" ? session.scramMaxIterations : DEFAULT_MAX_SCRAM_ITERATIONS;
      if (scramMaxIterations !== 0 && sv.iteration > scramMaxIterations) {
        throw new Error(
          "SASL: SCRAM-SERVER-FIRST-MESSAGE: iteration count " + sv.iteration + " exceeds scramMaxIterations of " + scramMaxIterations
        );
      }
      const clientFirstMessageBare = "n=*,r=" + session.clientNonce;
      const serverFirstMessage = "r=" + sv.nonce + ",s=" + sv.salt + ",i=" + sv.iteration;
      let channelBinding = stream ? "eSws" : "biws";
      if (session.mechanism === "SCRAM-SHA-256-PLUS") {
        const peerCert = stream.getPeerCertificate().raw;
        let hashName = signatureAlgorithmHashFromCertificate(peerCert);
        if (hashName === "MD5" || hashName === "SHA-1") hashName = "SHA-256";
        const certHash = await crypto2.hashByName(hashName, peerCert);
        const bindingData = Buffer.concat([Buffer.from("p=tls-server-end-point,,"), Buffer.from(certHash)]);
        channelBinding = bindingData.toString("base64");
      }
      const clientFinalMessageWithoutProof = "c=" + channelBinding + ",r=" + sv.nonce;
      const authMessage = clientFirstMessageBare + "," + serverFirstMessage + "," + clientFinalMessageWithoutProof;
      const saltBytes = Buffer.from(sv.salt, "base64");
      const saltedPassword = await crypto2.deriveKey(saslprep(password), saltBytes, sv.iteration);
      const clientKey = await crypto2.hmacSha256(saltedPassword, "Client Key");
      const storedKey = await crypto2.sha256(clientKey);
      const clientSignature = await crypto2.hmacSha256(storedKey, authMessage);
      const clientProof = xorBuffers(Buffer.from(clientKey), Buffer.from(clientSignature)).toString("base64");
      const serverKey = await crypto2.hmacSha256(saltedPassword, "Server Key");
      const serverSignatureBytes = await crypto2.hmacSha256(serverKey, authMessage);
      session.message = "SASLResponse";
      session.serverSignature = Buffer.from(serverSignatureBytes).toString("base64");
      session.response = clientFinalMessageWithoutProof + ",p=" + clientProof;
    }
    __name(continueSession, "continueSession");
    function finalizeSession(session, serverData) {
      if (session.message !== "SASLResponse") {
        throw new Error("SASL: Last message was not SASLResponse");
      }
      if (typeof serverData !== "string") {
        throw new Error("SASL: SCRAM-SERVER-FINAL-MESSAGE: serverData must be a string");
      }
      const { serverSignature } = parseServerFinalMessage(serverData);
      if (serverSignature !== session.serverSignature) {
        throw new Error("SASL: SCRAM-SERVER-FINAL-MESSAGE: server signature does not match");
      }
    }
    __name(finalizeSession, "finalizeSession");
    function isPrintableChars(text2) {
      if (typeof text2 !== "string") {
        throw new TypeError("SASL: text must be a string");
      }
      return text2.split("").map((_, i) => text2.charCodeAt(i)).every((c) => c >= 33 && c <= 43 || c >= 45 && c <= 126);
    }
    __name(isPrintableChars, "isPrintableChars");
    function isBase64(text2) {
      return /^(?:[a-zA-Z0-9+/]{4})*(?:[a-zA-Z0-9+/]{2}==|[a-zA-Z0-9+/]{3}=)?$/.test(text2);
    }
    __name(isBase64, "isBase64");
    function parseAttributePairs(text2) {
      if (typeof text2 !== "string") {
        throw new TypeError("SASL: attribute pairs text must be a string");
      }
      return new Map(
        text2.split(",").map((attrValue) => {
          if (!/^.=/.test(attrValue)) {
            throw new Error("SASL: Invalid attribute pair entry");
          }
          const name = attrValue[0];
          const value = attrValue.substring(2);
          return [name, value];
        })
      );
    }
    __name(parseAttributePairs, "parseAttributePairs");
    function parseServerFirstMessage(data) {
      const attrPairs = parseAttributePairs(data);
      const nonce = attrPairs.get("r");
      if (!nonce) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: nonce missing");
      } else if (!isPrintableChars(nonce)) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: nonce must only contain printable characters");
      }
      const salt = attrPairs.get("s");
      if (!salt) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: salt missing");
      } else if (!isBase64(salt)) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: salt must be base64");
      }
      const iterationText = attrPairs.get("i");
      if (!iterationText) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: iteration missing");
      } else if (!/^[1-9][0-9]*$/.test(iterationText)) {
        throw new Error("SASL: SCRAM-SERVER-FIRST-MESSAGE: invalid iteration count");
      }
      const iteration = parseInt(iterationText, 10);
      return {
        nonce,
        salt,
        iteration
      };
    }
    __name(parseServerFirstMessage, "parseServerFirstMessage");
    function parseServerFinalMessage(serverData) {
      const attrPairs = parseAttributePairs(serverData);
      const error = attrPairs.get("e");
      const serverSignature = attrPairs.get("v");
      if (error) {
        throw new Error(`SASL: SCRAM-SERVER-FINAL-MESSAGE: server returned error: "${error}"`);
      }
      if (!serverSignature) {
        throw new Error("SASL: SCRAM-SERVER-FINAL-MESSAGE: server signature is missing");
      } else if (!isBase64(serverSignature)) {
        throw new Error("SASL: SCRAM-SERVER-FINAL-MESSAGE: server signature must be base64");
      }
      return {
        serverSignature
      };
    }
    __name(parseServerFinalMessage, "parseServerFinalMessage");
    function xorBuffers(a, b) {
      if (!Buffer.isBuffer(a)) {
        throw new TypeError("first argument must be a Buffer");
      }
      if (!Buffer.isBuffer(b)) {
        throw new TypeError("second argument must be a Buffer");
      }
      if (a.length !== b.length) {
        throw new Error("Buffer lengths must match");
      }
      if (a.length === 0) {
        throw new Error("Buffers cannot be empty");
      }
      return Buffer.from(a.map((_, i) => a[i] ^ b[i]));
    }
    __name(xorBuffers, "xorBuffers");
    module.exports = {
      startSession,
      continueSession,
      finalizeSession,
      DEFAULT_MAX_SCRAM_ITERATIONS
    };
  }
});

// node_modules/pg/lib/type-overrides.js
var require_type_overrides = __commonJS({
  "node_modules/pg/lib/type-overrides.js"(exports, module) {
    "use strict";
    var types2 = require_pg_types();
    function TypeOverrides2(userTypes) {
      this._types = userTypes || types2;
      this.text = {};
      this.binary = {};
    }
    __name(TypeOverrides2, "TypeOverrides");
    TypeOverrides2.prototype.getOverrides = function(format) {
      switch (format) {
        case "text":
          return this.text;
        case "binary":
          return this.binary;
        default:
          return {};
      }
    };
    TypeOverrides2.prototype.setTypeParser = function(oid, format, parseFn) {
      if (typeof format === "function") {
        parseFn = format;
        format = "text";
      }
      this.getOverrides(format)[oid] = parseFn;
    };
    TypeOverrides2.prototype.getTypeParser = function(oid, format) {
      format = format || "text";
      return this.getOverrides(format)[oid] || this._types.getTypeParser(oid, format);
    };
    module.exports = TypeOverrides2;
  }
});

// node-built-in-modules:dns
import libDefault5 from "dns";
var require_dns = __commonJS({
  "node-built-in-modules:dns"(exports, module) {
    module.exports = libDefault5;
  }
});

// node-built-in-modules:fs
import libDefault6 from "fs";
var require_fs = __commonJS({
  "node-built-in-modules:fs"(exports, module) {
    module.exports = libDefault6;
  }
});

// node_modules/pg-connection-string/index.js
var require_pg_connection_string = __commonJS({
  "node_modules/pg-connection-string/index.js"(exports, module) {
    "use strict";
    function parse2(str, options = {}) {
      if (str.charAt(0) === "/") {
        const config2 = str.split(" ");
        return { host: config2[0], database: config2[1] };
      }
      const config = /* @__PURE__ */ Object.create(null);
      let result;
      let dummyHost = false;
      if (/ |%[^a-f0-9]|%[a-f0-9][^a-f0-9]/i.test(str)) {
        str = encodeURI(str).replace(/%25(\d\d)/g, "%$1");
      }
      try {
        try {
          result = new URL(str, "postgres://base");
        } catch (e) {
          result = new URL(str.replace("@/", "@___DUMMY___/"), "postgres://base");
          dummyHost = true;
        }
      } catch (err) {
        err.input && (err.input = "*****REDACTED*****");
        throw err;
      }
      for (const entry of result.searchParams.entries()) {
        config[entry[0]] = entry[1];
      }
      config.user = config.user || decodeURIComponent(result.username);
      config.password = config.password || decodeURIComponent(result.password);
      if (result.protocol == "socket:") {
        config.host = decodeURI(result.pathname);
        config.database = result.searchParams.get("db");
        config.client_encoding = result.searchParams.get("encoding");
        return config;
      }
      const hostname = dummyHost ? "" : result.hostname;
      if (!config.host) {
        config.host = decodeURIComponent(hostname);
      } else if (hostname && /^%2f/i.test(hostname)) {
        result.pathname = hostname + result.pathname;
      }
      if (!config.port) {
        config.port = result.port;
      }
      const pathname = result.pathname.slice(1) || null;
      config.database = pathname ? decodeURI(pathname) : null;
      if (config.ssl === "true" || config.ssl === "1") {
        config.ssl = true;
      }
      if (config.ssl === "0") {
        config.ssl = false;
      }
      if (config.sslcert || config.sslkey || config.sslrootcert || config.sslmode) {
        config.ssl = {};
      }
      if (config.sslnegotiation === "direct" && config.ssl === void 0) {
        config.ssl = true;
      }
      const fs = config.sslcert || config.sslkey || config.sslrootcert ? require_fs() : null;
      if (config.sslcert) {
        config.ssl.cert = fs.readFileSync(config.sslcert).toString();
      }
      if (config.sslkey) {
        config.ssl.key = fs.readFileSync(config.sslkey).toString();
      }
      if (config.sslrootcert) {
        config.ssl.ca = fs.readFileSync(config.sslrootcert).toString();
      }
      if (options.useLibpqCompat && config.uselibpqcompat) {
        throw new Error("Both useLibpqCompat and uselibpqcompat are set. Please use only one of them.");
      }
      if (config.uselibpqcompat === "true" || options.useLibpqCompat) {
        switch (config.sslmode) {
          case "disable": {
            config.ssl = false;
            break;
          }
          case "prefer": {
            config.ssl.rejectUnauthorized = false;
            break;
          }
          case "require": {
            if (config.sslrootcert) {
              config.ssl.checkServerIdentity = function() {
              };
            } else {
              config.ssl.rejectUnauthorized = false;
            }
            break;
          }
          case "verify-ca": {
            if (!config.ssl.ca) {
              throw new Error(
                "SECURITY WARNING: Using sslmode=verify-ca requires specifying a CA with sslrootcert. If a public CA is used, verify-ca allows connections to a server that somebody else may have registered with the CA, making you vulnerable to Man-in-the-Middle attacks. Either specify a custom CA certificate with sslrootcert parameter or use sslmode=verify-full for proper security."
              );
            }
            config.ssl.checkServerIdentity = function() {
            };
            break;
          }
          case "verify-full": {
            break;
          }
        }
      } else {
        switch (config.sslmode) {
          case "disable": {
            config.ssl = false;
            break;
          }
          case "prefer":
          case "require":
          case "verify-ca":
          case "verify-full": {
            if (config.sslmode !== "verify-full") {
              deprecatedSslModeWarning(config.sslmode);
            }
            break;
          }
          case "no-verify": {
            config.ssl.rejectUnauthorized = false;
            break;
          }
        }
      }
      return config;
    }
    __name(parse2, "parse");
    function toConnectionOptions(sslConfig) {
      const connectionOptions = Object.entries(sslConfig).reduce((c, [key, value]) => {
        if (value !== void 0 && value !== null) {
          c[key] = value;
        }
        return c;
      }, /* @__PURE__ */ Object.create(null));
      return connectionOptions;
    }
    __name(toConnectionOptions, "toConnectionOptions");
    function toClientConfig(config) {
      const poolConfig = Object.entries(config).reduce((c, [key, value]) => {
        if (key === "ssl") {
          const sslConfig = value;
          if (typeof sslConfig === "boolean") {
            c[key] = sslConfig;
          }
          if (typeof sslConfig === "object") {
            c[key] = toConnectionOptions(sslConfig);
          }
        } else if (value !== void 0 && value !== null) {
          if (key === "port") {
            if (value !== "") {
              const v = parseInt(value, 10);
              if (isNaN(v)) {
                throw new Error(`Invalid ${key}: ${value}`);
              }
              c[key] = v;
            }
          } else {
            c[key] = value;
          }
        }
        return c;
      }, /* @__PURE__ */ Object.create(null));
      return poolConfig;
    }
    __name(toClientConfig, "toClientConfig");
    function parseIntoClientConfig(str) {
      return toClientConfig(parse2(str));
    }
    __name(parseIntoClientConfig, "parseIntoClientConfig");
    function deprecatedSslModeWarning(sslmode) {
      if (!deprecatedSslModeWarning.warned && typeof process !== "undefined" && process.emitWarning) {
        deprecatedSslModeWarning.warned = true;
        process.emitWarning(`SECURITY WARNING: The SSL modes 'prefer', 'require', and 'verify-ca' are treated as aliases for 'verify-full'.
In the next major version (pg-connection-string v3.0.0 and pg v9.0.0), these modes will adopt standard libpq semantics, which have weaker security guarantees.

To prepare for this change:
- If you want the current behavior, explicitly use 'sslmode=verify-full'
- If you want libpq compatibility now, use 'uselibpqcompat=true&sslmode=${sslmode}'

See https://www.postgresql.org/docs/current/libpq-ssl.html for libpq SSL mode definitions.`);
      }
    }
    __name(deprecatedSslModeWarning, "deprecatedSslModeWarning");
    module.exports = parse2;
    parse2.parse = parse2;
    parse2.toClientConfig = toClientConfig;
    parse2.parseIntoClientConfig = parseIntoClientConfig;
  }
});

// node_modules/pg/lib/connection-parameters.js
var require_connection_parameters = __commonJS({
  "node_modules/pg/lib/connection-parameters.js"(exports, module) {
    "use strict";
    var dns = require_dns();
    var defaults2 = require_defaults();
    var parse2 = require_pg_connection_string().parse;
    var val = /* @__PURE__ */ __name(function(key, config, envVar) {
      if (config[key]) {
        return config[key];
      }
      if (envVar === void 0) {
        envVar = process.env["PG" + key.toUpperCase()];
      } else if (envVar === false) {
      } else {
        envVar = process.env[envVar];
      }
      return envVar || defaults2[key];
    }, "val");
    var readSSLConfigFromEnvironment = /* @__PURE__ */ __name(function() {
      switch (process.env.PGSSLMODE) {
        case "disable":
          return false;
        case "prefer":
        case "require":
        case "verify-ca":
        case "verify-full":
          return true;
        case "no-verify":
          return { rejectUnauthorized: false };
      }
      return defaults2.ssl;
    }, "readSSLConfigFromEnvironment");
    var quoteParamValue = /* @__PURE__ */ __name(function(value) {
      return "'" + ("" + value).replace(/\\/g, "\\\\").replace(/'/g, "\\'") + "'";
    }, "quoteParamValue");
    var add = /* @__PURE__ */ __name(function(params, config, paramName) {
      const value = config[paramName];
      if (value !== void 0 && value !== null) {
        params.push(paramName + "=" + quoteParamValue(value));
      }
    }, "add");
    var ConnectionParameters = class {
      static {
        __name(this, "ConnectionParameters");
      }
      constructor(config) {
        config = typeof config === "string" ? parse2(config) : config || {};
        if (config.connectionString) {
          config = Object.assign({}, config, parse2(config.connectionString));
        }
        this.user = val("user", config);
        this.database = val("database", config);
        if (this.database === void 0) {
          this.database = this.user;
        }
        this.port = parseInt(val("port", config), 10);
        this.host = val("host", config);
        Object.defineProperty(this, "password", {
          configurable: true,
          enumerable: false,
          writable: true,
          value: val("password", config)
        });
        this.binary = val("binary", config);
        this.options = val("options", config);
        this.ssl = typeof config.ssl === "undefined" ? readSSLConfigFromEnvironment() : config.ssl;
        if (typeof this.ssl === "string") {
          if (this.ssl === "true") {
            this.ssl = true;
          }
        }
        if (this.ssl === "no-verify") {
          this.ssl = { rejectUnauthorized: false };
        }
        if (this.ssl && this.ssl.key) {
          Object.defineProperty(this.ssl, "key", {
            enumerable: false
          });
        }
        this.sslnegotiation = val("sslnegotiation", config, "PGSSLNEGOTIATION");
        if (this.sslnegotiation !== void 0 && this.sslnegotiation !== "postgres" && this.sslnegotiation !== "direct") {
          throw new Error(
            `Invalid sslnegotiation value: "${this.sslnegotiation}". Valid values are "postgres" and "direct".`
          );
        }
        if (this.sslnegotiation === "direct" && !this.ssl) {
          throw new Error("sslnegotiation=direct requires SSL to be enabled");
        }
        this.client_encoding = val("client_encoding", config);
        this.replication = val("replication", config);
        this.isDomainSocket = !(this.host || "").indexOf("/");
        this.application_name = val("application_name", config, "PGAPPNAME");
        this.fallback_application_name = val("fallback_application_name", config, false);
        this.statement_timeout = val("statement_timeout", config, false);
        this.lock_timeout = val("lock_timeout", config, false);
        this.idle_in_transaction_session_timeout = val("idle_in_transaction_session_timeout", config, false);
        this.query_timeout = val("query_timeout", config, false);
        if (config.connectionTimeoutMillis === void 0) {
          this.connect_timeout = process.env.PGCONNECT_TIMEOUT || 0;
        } else {
          this.connect_timeout = Math.floor(config.connectionTimeoutMillis / 1e3);
        }
        if (config.keepAlive === false) {
          this.keepalives = 0;
        } else if (config.keepAlive === true) {
          this.keepalives = 1;
        }
        if (typeof config.keepAliveInitialDelayMillis === "number") {
          this.keepalives_idle = Math.floor(config.keepAliveInitialDelayMillis / 1e3);
        }
      }
      getLibpqConnectionString(cb) {
        const params = [];
        add(params, this, "user");
        add(params, this, "password");
        add(params, this, "port");
        add(params, this, "application_name");
        add(params, this, "fallback_application_name");
        add(params, this, "connect_timeout");
        add(params, this, "options");
        const ssl = typeof this.ssl === "object" ? this.ssl : this.ssl ? { sslmode: this.ssl } : {};
        add(params, ssl, "sslmode");
        add(params, ssl, "sslca");
        add(params, ssl, "sslkey");
        add(params, ssl, "sslcert");
        add(params, ssl, "sslrootcert");
        add(params, this, "sslnegotiation");
        if (this.database) {
          params.push("dbname=" + quoteParamValue(this.database));
        }
        if (this.replication) {
          params.push("replication=" + quoteParamValue(this.replication));
        }
        if (this.host) {
          params.push("host=" + quoteParamValue(this.host));
        }
        if (this.isDomainSocket) {
          return cb(null, params.join(" "));
        }
        if (this.client_encoding) {
          params.push("client_encoding=" + quoteParamValue(this.client_encoding));
        }
        dns.lookup(this.host, function(err, address) {
          if (err) return cb(err, null);
          params.push("hostaddr=" + quoteParamValue(address));
          return cb(null, params.join(" "));
        });
      }
    };
    module.exports = ConnectionParameters;
  }
});

// node_modules/pg/lib/result.js
var require_result = __commonJS({
  "node_modules/pg/lib/result.js"(exports, module) {
    "use strict";
    var types2 = require_pg_types();
    var matchRegexp = /^([A-Za-z]+)(?: (\d+))?(?: (\d+))?/;
    var Result2 = class {
      static {
        __name(this, "Result");
      }
      constructor(rowMode, types3) {
        this.command = null;
        this.rowCount = null;
        this.oid = null;
        this.rows = [];
        this.fields = [];
        this._parsers = void 0;
        this._types = types3;
        this.RowCtor = null;
        this.rowAsArray = rowMode === "array";
        if (this.rowAsArray) {
          this.parseRow = this._parseRowAsArray;
        }
        this._prebuiltEmptyResultObject = null;
      }
      // adds a command complete message
      addCommandComplete(msg) {
        let match2;
        if (msg.text) {
          match2 = matchRegexp.exec(msg.text);
        } else {
          match2 = matchRegexp.exec(msg.command);
        }
        if (match2) {
          this.command = match2[1];
          if (match2[3]) {
            this.oid = parseInt(match2[2], 10);
            this.rowCount = parseInt(match2[3], 10);
          } else if (match2[2]) {
            this.rowCount = parseInt(match2[2], 10);
          }
        }
      }
      _parseRowAsArray(rowData) {
        const row = new Array(rowData.length);
        for (let i = 0, len = rowData.length; i < len; i++) {
          const rawValue = rowData[i];
          if (rawValue !== null) {
            row[i] = this._parsers[i](rawValue);
          } else {
            row[i] = null;
          }
        }
        return row;
      }
      parseRow(rowData) {
        const row = { ...this._prebuiltEmptyResultObject };
        for (let i = 0, len = rowData.length; i < len; i++) {
          const rawValue = rowData[i];
          const field = this.fields[i].name;
          if (rawValue !== null) {
            const v = this.fields[i].format === "binary" ? Buffer.from(rawValue) : rawValue;
            row[field] = this._parsers[i](v);
          } else {
            row[field] = null;
          }
        }
        return row;
      }
      addRow(row) {
        this.rows.push(row);
      }
      addFields(fieldDescriptions) {
        this.fields = fieldDescriptions;
        if (this.fields.length) {
          this._parsers = new Array(fieldDescriptions.length);
        }
        const row = /* @__PURE__ */ Object.create(null);
        for (let i = 0; i < fieldDescriptions.length; i++) {
          const desc = fieldDescriptions[i];
          row[desc.name] = null;
          if (this._types) {
            this._parsers[i] = this._types.getTypeParser(desc.dataTypeID, desc.format || "text");
          } else {
            this._parsers[i] = types2.getTypeParser(desc.dataTypeID, desc.format || "text");
          }
        }
        this._prebuiltEmptyResultObject = { ...row };
      }
    };
    module.exports = Result2;
  }
});

// node_modules/pg/lib/query.js
var require_query = __commonJS({
  "node_modules/pg/lib/query.js"(exports, module) {
    "use strict";
    var { EventEmitter } = require_events();
    var Result2 = require_result();
    var utils = require_utils();
    var Query2 = class extends EventEmitter {
      static {
        __name(this, "Query");
      }
      constructor(config, values, callback) {
        super();
        config = utils.normalizeQueryConfig(config, values, callback);
        this.text = config.text;
        this.values = config.values;
        this.rows = config.rows;
        this.types = config.types;
        this.name = config.name;
        this.queryMode = config.queryMode;
        this.binary = config.binary;
        this.portal = config.portal || "";
        this.callback = config.callback;
        this._rowMode = config.rowMode;
        if (process.domain && config.callback) {
          this.callback = process.domain.bind(config.callback);
        }
        this._result = new Result2(this._rowMode, this.types);
        this._results = this._result;
        this._canceledDueToError = false;
      }
      requiresPreparation() {
        if (this.queryMode === "extended") {
          return true;
        }
        if (this.name) {
          return true;
        }
        if (this.rows) {
          return true;
        }
        if (!this.text) {
          return false;
        }
        if (!this.values) {
          return false;
        }
        return this.values.length > 0;
      }
      _checkForMultirow() {
        if (this._result.command) {
          if (!Array.isArray(this._results)) {
            this._results = [this._result];
          }
          this._result = new Result2(this._rowMode, this._result._types);
          this._results.push(this._result);
        }
      }
      // associates row metadata from the supplied
      // message with this query object
      // metadata used when parsing row results
      handleRowDescription(msg) {
        this._checkForMultirow();
        this._result.addFields(msg.fields);
        this._accumulateRows = this.callback || !this.listeners("row").length;
      }
      handleDataRow(msg) {
        let row;
        if (this._canceledDueToError) {
          return;
        }
        try {
          row = this._result.parseRow(msg.fields);
        } catch (err) {
          this._canceledDueToError = err;
          return;
        }
        this.emit("row", row, this._result);
        if (this._accumulateRows) {
          this._result.addRow(row);
        }
      }
      handleCommandComplete(msg, connection) {
        this._checkForMultirow();
        this._result.addCommandComplete(msg);
        if (this.rows) {
          connection.sync();
        }
      }
      // if a named prepared statement is created with empty query text
      // the backend will send an emptyQuery message but *not* a command complete message
      // since we pipeline sync immediately after execute we don't need to do anything here
      // unless we have rows specified, in which case we did not pipeline the initial sync call
      handleEmptyQuery(connection) {
        if (this.rows) {
          connection.sync();
        }
      }
      handleError(err, connection) {
        if (this._canceledDueToError) {
          err = this._canceledDueToError;
          this._canceledDueToError = false;
        }
        if (this.callback) {
          return this.callback(err);
        }
        this.emit("error", err);
      }
      handleReadyForQuery(con) {
        if (this._canceledDueToError) {
          return this.handleError(this._canceledDueToError, con);
        }
        if (this.callback) {
          try {
            this.callback(null, this._results);
          } catch (err) {
            process.nextTick(() => {
              throw err;
            });
          }
        }
        this.emit("end", this._results);
      }
      submit(connection) {
        if (typeof this.text !== "string" && typeof this.name !== "string") {
          return new Error("A query must have either text or a name. Supplying neither is unsupported.");
        }
        const previous = connection.parsedStatements[this.name] || connection.submittedNamedStatements[this.name];
        if (this.text && previous && this.text !== previous) {
          return new Error(`Prepared statements must be unique - '${this.name}' was used for a different statement`);
        }
        if (this.values && !Array.isArray(this.values)) {
          return new Error("Query values must be an array");
        }
        if (this.requiresPreparation()) {
          connection.stream.cork && connection.stream.cork();
          try {
            this.prepare(connection);
          } finally {
            connection.stream.uncork && connection.stream.uncork();
          }
        } else {
          connection.query(this.text);
        }
        return null;
      }
      hasBeenParsed(connection) {
        return this.name && (connection.parsedStatements[this.name] || connection.submittedNamedStatements[this.name]);
      }
      handlePortalSuspended(connection) {
        this._getRows(connection, this.rows);
      }
      _getRows(connection, rows) {
        connection.execute({
          portal: this.portal,
          rows
        });
        if (!rows) {
          connection.sync();
        } else {
          connection.flush();
        }
      }
      // http://developer.postgresql.org/pgdocs/postgres/protocol-flow.html#PROTOCOL-FLOW-EXT-QUERY
      prepare(connection) {
        if (!this.hasBeenParsed(connection)) {
          connection.parse({
            text: this.text,
            name: this.name,
            types: this.types
          });
          if (this.name) {
            connection.submittedNamedStatements[this.name] = this.text;
          }
        }
        try {
          connection.bind({
            portal: this.portal,
            statement: this.name,
            values: this.values,
            binary: this.binary,
            valueMapper: utils.prepareValue
          });
        } catch (err) {
          connection.close({ type: "S", name: this.name });
          connection.sync();
          this.handleError(err, connection);
          return;
        }
        connection.describe({
          type: "P",
          name: this.portal || ""
        });
        this._getRows(connection, this.rows);
      }
      handleCopyInResponse(connection) {
        connection.sendCopyFail("No source stream defined");
      }
      handleCopyData(msg, connection) {
      }
    };
    module.exports = Query2;
  }
});

// node_modules/pg-protocol/dist/messages.js
var require_messages = __commonJS({
  "node_modules/pg-protocol/dist/messages.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.NoticeMessage = exports.DataRowMessage = exports.CommandCompleteMessage = exports.ReadyForQueryMessage = exports.NotificationResponseMessage = exports.BackendKeyDataMessage = exports.AuthenticationMD5Password = exports.ParameterStatusMessage = exports.ParameterDescriptionMessage = exports.RowDescriptionMessage = exports.Field = exports.CopyResponse = exports.CopyDataMessage = exports.DatabaseError = exports.copyDone = exports.emptyQuery = exports.replicationStart = exports.portalSuspended = exports.noData = exports.closeComplete = exports.bindComplete = exports.parseComplete = void 0;
    exports.parseComplete = {
      name: "parseComplete",
      length: 5
    };
    exports.bindComplete = {
      name: "bindComplete",
      length: 5
    };
    exports.closeComplete = {
      name: "closeComplete",
      length: 5
    };
    exports.noData = {
      name: "noData",
      length: 5
    };
    exports.portalSuspended = {
      name: "portalSuspended",
      length: 5
    };
    exports.replicationStart = {
      name: "replicationStart",
      length: 4
    };
    exports.emptyQuery = {
      name: "emptyQuery",
      length: 4
    };
    exports.copyDone = {
      name: "copyDone",
      length: 4
    };
    var DatabaseError2 = class extends Error {
      static {
        __name(this, "DatabaseError");
      }
      constructor(message, length, name) {
        super(message);
        this.length = length;
        this.name = name;
      }
    };
    exports.DatabaseError = DatabaseError2;
    var CopyDataMessage = class {
      static {
        __name(this, "CopyDataMessage");
      }
      constructor(length, chunk) {
        this.length = length;
        this.chunk = chunk;
        this.name = "copyData";
      }
    };
    exports.CopyDataMessage = CopyDataMessage;
    var CopyResponse = class {
      static {
        __name(this, "CopyResponse");
      }
      constructor(length, name, binary, columnCount) {
        this.length = length;
        this.name = name;
        this.binary = binary;
        this.columnTypes = new Array(columnCount);
      }
    };
    exports.CopyResponse = CopyResponse;
    var Field = class {
      static {
        __name(this, "Field");
      }
      constructor(name, tableID, columnID, dataTypeID, dataTypeSize, dataTypeModifier, format) {
        this.name = name;
        this.tableID = tableID;
        this.columnID = columnID;
        this.dataTypeID = dataTypeID;
        this.dataTypeSize = dataTypeSize;
        this.dataTypeModifier = dataTypeModifier;
        this.format = format;
      }
    };
    exports.Field = Field;
    var RowDescriptionMessage = class {
      static {
        __name(this, "RowDescriptionMessage");
      }
      constructor(length, fieldCount) {
        this.length = length;
        this.fieldCount = fieldCount;
        this.name = "rowDescription";
        this.fields = new Array(this.fieldCount);
      }
    };
    exports.RowDescriptionMessage = RowDescriptionMessage;
    var ParameterDescriptionMessage = class {
      static {
        __name(this, "ParameterDescriptionMessage");
      }
      constructor(length, parameterCount) {
        this.length = length;
        this.parameterCount = parameterCount;
        this.name = "parameterDescription";
        this.dataTypeIDs = new Array(this.parameterCount);
      }
    };
    exports.ParameterDescriptionMessage = ParameterDescriptionMessage;
    var ParameterStatusMessage = class {
      static {
        __name(this, "ParameterStatusMessage");
      }
      constructor(length, parameterName, parameterValue) {
        this.length = length;
        this.parameterName = parameterName;
        this.parameterValue = parameterValue;
        this.name = "parameterStatus";
      }
    };
    exports.ParameterStatusMessage = ParameterStatusMessage;
    var AuthenticationMD5Password = class {
      static {
        __name(this, "AuthenticationMD5Password");
      }
      constructor(length, salt) {
        this.length = length;
        this.salt = salt;
        this.name = "authenticationMD5Password";
      }
    };
    exports.AuthenticationMD5Password = AuthenticationMD5Password;
    var BackendKeyDataMessage = class {
      static {
        __name(this, "BackendKeyDataMessage");
      }
      constructor(length, processID, secretKey) {
        this.length = length;
        this.processID = processID;
        this.secretKey = secretKey;
        this.name = "backendKeyData";
      }
    };
    exports.BackendKeyDataMessage = BackendKeyDataMessage;
    var NotificationResponseMessage = class {
      static {
        __name(this, "NotificationResponseMessage");
      }
      constructor(length, processId, channel, payload) {
        this.length = length;
        this.processId = processId;
        this.channel = channel;
        this.payload = payload;
        this.name = "notification";
      }
    };
    exports.NotificationResponseMessage = NotificationResponseMessage;
    var ReadyForQueryMessage = class {
      static {
        __name(this, "ReadyForQueryMessage");
      }
      constructor(length, status) {
        this.length = length;
        this.status = status;
        this.name = "readyForQuery";
      }
    };
    exports.ReadyForQueryMessage = ReadyForQueryMessage;
    var CommandCompleteMessage = class {
      static {
        __name(this, "CommandCompleteMessage");
      }
      constructor(length, text2) {
        this.length = length;
        this.text = text2;
        this.name = "commandComplete";
      }
    };
    exports.CommandCompleteMessage = CommandCompleteMessage;
    var DataRowMessage = class {
      static {
        __name(this, "DataRowMessage");
      }
      constructor(length, fields) {
        this.length = length;
        this.fields = fields;
        this.name = "dataRow";
        this.fieldCount = fields.length;
      }
    };
    exports.DataRowMessage = DataRowMessage;
    var NoticeMessage = class {
      static {
        __name(this, "NoticeMessage");
      }
      constructor(length, message) {
        this.length = length;
        this.message = message;
        this.name = "notice";
      }
    };
    exports.NoticeMessage = NoticeMessage;
  }
});

// node_modules/pg-protocol/dist/buffer-writer.js
var require_buffer_writer = __commonJS({
  "node_modules/pg-protocol/dist/buffer-writer.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.Writer = void 0;
    var Writer = class {
      static {
        __name(this, "Writer");
      }
      constructor(size = 256) {
        this.size = size;
        this.offset = 5;
        this.headerPosition = 0;
        this.buffer = Buffer.allocUnsafe(size);
      }
      ensure(size) {
        const remaining = this.buffer.length - this.offset;
        if (remaining < size) {
          const oldBuffer = this.buffer;
          const newSize = oldBuffer.length + (oldBuffer.length >> 1) + size;
          this.buffer = Buffer.allocUnsafe(newSize);
          oldBuffer.copy(this.buffer);
        }
      }
      addInt32(num) {
        this.ensure(4);
        this.buffer[this.offset++] = num >>> 24 & 255;
        this.buffer[this.offset++] = num >>> 16 & 255;
        this.buffer[this.offset++] = num >>> 8 & 255;
        this.buffer[this.offset++] = num >>> 0 & 255;
        return this;
      }
      addInt16(num) {
        this.ensure(2);
        this.buffer[this.offset++] = num >>> 8 & 255;
        this.buffer[this.offset++] = num >>> 0 & 255;
        return this;
      }
      addCString(string) {
        if (!string) {
          this.ensure(1);
        } else {
          const len = Buffer.byteLength(string);
          this.ensure(len + 1);
          this.buffer.write(string, this.offset, "utf-8");
          this.offset += len;
        }
        this.buffer[this.offset++] = 0;
        return this;
      }
      addString(string = "") {
        const len = Buffer.byteLength(string);
        this.ensure(len);
        this.buffer.write(string, this.offset);
        this.offset += len;
        return this;
      }
      // Write an Int32 byte-length prefix immediately followed by the string's UTF-8
      // bytes. Postgres' Bind wire format prefixes every parameter with its length,
      // and doing it in one method computes Buffer.byteLength ONCE — the previous
      // `addInt32(Buffer.byteLength(s)).addString(s)` pairing scanned the string
      // three times (byteLength for the prefix, byteLength again inside addString,
      // then the encode), which is costly for large text parameters.
      addInt32PrefixedString(string) {
        const len = Buffer.byteLength(string);
        this.ensure(4 + len);
        const buffer = this.buffer;
        let offset = this.offset;
        buffer[offset++] = len >>> 24 & 255;
        buffer[offset++] = len >>> 16 & 255;
        buffer[offset++] = len >>> 8 & 255;
        buffer[offset++] = len >>> 0 & 255;
        buffer.write(string, offset, "utf-8");
        this.offset = offset + len;
        return this;
      }
      add(otherBuffer) {
        this.ensure(otherBuffer.length);
        otherBuffer.copy(this.buffer, this.offset);
        this.offset += otherBuffer.length;
        return this;
      }
      join(code) {
        if (code) {
          this.buffer[this.headerPosition] = code;
          const length = this.offset - (this.headerPosition + 1);
          this.buffer.writeInt32BE(length, this.headerPosition + 1);
        }
        return this.buffer.slice(code ? 0 : 5, this.offset);
      }
      flush(code) {
        const result = this.join(code);
        this.offset = 5;
        this.headerPosition = 0;
        this.buffer = Buffer.allocUnsafe(this.size);
        return result;
      }
      clear() {
        this.offset = 5;
        this.headerPosition = 0;
      }
    };
    exports.Writer = Writer;
  }
});

// node_modules/pg-protocol/dist/serializer.js
var require_serializer = __commonJS({
  "node_modules/pg-protocol/dist/serializer.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.serialize = void 0;
    var buffer_writer_1 = require_buffer_writer();
    var writer = new buffer_writer_1.Writer();
    var startup = /* @__PURE__ */ __name((opts) => {
      writer.addInt16(3).addInt16(0);
      for (const key of Object.keys(opts)) {
        writer.addCString(key).addCString(opts[key]);
      }
      writer.addCString("client_encoding").addCString("UTF8");
      const bodyBuffer = writer.addCString("").flush();
      const length = bodyBuffer.length + 4;
      return new buffer_writer_1.Writer().addInt32(length).add(bodyBuffer).flush();
    }, "startup");
    var requestSsl = /* @__PURE__ */ __name(() => {
      const response = Buffer.allocUnsafe(8);
      response.writeInt32BE(8, 0);
      response.writeInt32BE(80877103, 4);
      return response;
    }, "requestSsl");
    var password = /* @__PURE__ */ __name((password2) => {
      return writer.addCString(password2).flush(
        112
        /* code.startup */
      );
    }, "password");
    var sendSASLInitialResponseMessage = /* @__PURE__ */ __name(function(mechanism, initialResponse) {
      writer.addCString(mechanism).addInt32PrefixedString(initialResponse);
      return writer.flush(
        112
        /* code.startup */
      );
    }, "sendSASLInitialResponseMessage");
    var sendSCRAMClientFinalMessage = /* @__PURE__ */ __name(function(additionalData) {
      return writer.addString(additionalData).flush(
        112
        /* code.startup */
      );
    }, "sendSCRAMClientFinalMessage");
    var query = /* @__PURE__ */ __name((text2) => {
      return writer.addCString(text2).flush(
        81
        /* code.query */
      );
    }, "query");
    var emptyArray = [];
    var parse2 = /* @__PURE__ */ __name((query2) => {
      const name = query2.name || "";
      if (name.length > 63) {
        console.error("Warning! Postgres only supports 63 characters for query names.");
        console.error("You supplied %s (%s)", name, name.length);
        console.error("This can cause conflicts and silent errors executing queries");
      }
      const types2 = query2.types || emptyArray;
      const len = types2.length;
      const buffer = writer.addCString(name).addCString(query2.text).addInt16(len);
      for (let i = 0; i < len; i++) {
        buffer.addInt32(types2[i]);
      }
      return writer.flush(
        80
        /* code.parse */
      );
    }, "parse");
    var paramWriter = new buffer_writer_1.Writer();
    var writeValues = /* @__PURE__ */ __name(function(values, valueMapper) {
      for (let i = 0; i < values.length; i++) {
        const mappedVal = valueMapper ? valueMapper(values[i], i) : values[i];
        if (mappedVal == null) {
          writer.addInt16(
            0
            /* ParamType.STRING */
          );
          paramWriter.addInt32(-1);
        } else if (mappedVal instanceof Buffer) {
          writer.addInt16(
            1
            /* ParamType.BINARY */
          );
          paramWriter.addInt32(mappedVal.length);
          paramWriter.add(mappedVal);
        } else {
          writer.addInt16(
            0
            /* ParamType.STRING */
          );
          paramWriter.addInt32PrefixedString(mappedVal);
        }
      }
    }, "writeValues");
    var bind = /* @__PURE__ */ __name((config = {}) => {
      const portal = config.portal || "";
      const statement = config.statement || "";
      const binary = config.binary || false;
      const values = config.values || emptyArray;
      const len = values.length;
      writer.addCString(portal).addCString(statement);
      writer.addInt16(len);
      try {
        writeValues(values, config.valueMapper);
      } catch (err) {
        writer.clear();
        paramWriter.clear();
        throw err;
      }
      writer.addInt16(len);
      writer.add(paramWriter.flush());
      writer.addInt16(1);
      writer.addInt16(
        binary ? 1 : 0
        /* ParamType.STRING */
      );
      return writer.flush(
        66
        /* code.bind */
      );
    }, "bind");
    var emptyExecute = Buffer.from([69, 0, 0, 0, 9, 0, 0, 0, 0, 0]);
    var execute = /* @__PURE__ */ __name((config) => {
      if (!config || !config.portal && !config.rows) {
        return emptyExecute;
      }
      const portal = config.portal || "";
      const rows = config.rows || 0;
      const portalLength = Buffer.byteLength(portal);
      const len = 4 + portalLength + 1 + 4;
      const buff = Buffer.allocUnsafe(1 + len);
      buff[0] = 69;
      buff.writeInt32BE(len, 1);
      buff.write(portal, 5, "utf-8");
      buff[portalLength + 5] = 0;
      buff.writeUInt32BE(rows, buff.length - 4);
      return buff;
    }, "execute");
    var cancel = /* @__PURE__ */ __name((processID, secretKey) => {
      const buffer = Buffer.allocUnsafe(16);
      buffer.writeInt32BE(16, 0);
      buffer.writeInt16BE(1234, 4);
      buffer.writeInt16BE(5678, 6);
      buffer.writeInt32BE(processID, 8);
      buffer.writeInt32BE(secretKey, 12);
      return buffer;
    }, "cancel");
    var cstringMessage = /* @__PURE__ */ __name((code, string) => {
      const stringLen = Buffer.byteLength(string);
      const len = 4 + stringLen + 1;
      const buffer = Buffer.allocUnsafe(1 + len);
      buffer[0] = code;
      buffer.writeInt32BE(len, 1);
      buffer.write(string, 5, "utf-8");
      buffer[len] = 0;
      return buffer;
    }, "cstringMessage");
    var emptyDescribePortal = writer.addCString("P").flush(
      68
      /* code.describe */
    );
    var emptyDescribeStatement = writer.addCString("S").flush(
      68
      /* code.describe */
    );
    var describe = /* @__PURE__ */ __name((msg) => {
      return msg.name ? cstringMessage(68, `${msg.type}${msg.name || ""}`) : msg.type === "P" ? emptyDescribePortal : emptyDescribeStatement;
    }, "describe");
    var close = /* @__PURE__ */ __name((msg) => {
      const text2 = `${msg.type}${msg.name || ""}`;
      return cstringMessage(67, text2);
    }, "close");
    var copyData = /* @__PURE__ */ __name((chunk) => {
      return writer.add(chunk).flush(
        100
        /* code.copyFromChunk */
      );
    }, "copyData");
    var copyFail = /* @__PURE__ */ __name((message) => {
      return cstringMessage(102, message);
    }, "copyFail");
    var codeOnlyBuffer = /* @__PURE__ */ __name((code) => Buffer.from([code, 0, 0, 0, 4]), "codeOnlyBuffer");
    var flushBuffer = codeOnlyBuffer(
      72
      /* code.flush */
    );
    var syncBuffer = codeOnlyBuffer(
      83
      /* code.sync */
    );
    var endBuffer = codeOnlyBuffer(
      88
      /* code.end */
    );
    var copyDoneBuffer = codeOnlyBuffer(
      99
      /* code.copyDone */
    );
    var serialize2 = {
      startup,
      password,
      requestSsl,
      sendSASLInitialResponseMessage,
      sendSCRAMClientFinalMessage,
      query,
      parse: parse2,
      bind,
      execute,
      describe,
      close,
      flush: /* @__PURE__ */ __name(() => flushBuffer, "flush"),
      sync: /* @__PURE__ */ __name(() => syncBuffer, "sync"),
      end: /* @__PURE__ */ __name(() => endBuffer, "end"),
      copyData,
      copyDone: /* @__PURE__ */ __name(() => copyDoneBuffer, "copyDone"),
      copyFail,
      cancel
    };
    exports.serialize = serialize2;
  }
});

// node_modules/pg-protocol/dist/buffer-reader.js
var require_buffer_reader = __commonJS({
  "node_modules/pg-protocol/dist/buffer-reader.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.BufferReader = void 0;
    var BufferReader = class {
      static {
        __name(this, "BufferReader");
      }
      constructor(offset = 0) {
        this.offset = offset;
        this.buffer = Buffer.allocUnsafe(0);
        this.encoding = "utf-8";
      }
      setBuffer(offset, buffer) {
        this.offset = offset;
        this.buffer = buffer;
      }
      int16() {
        const result = this.buffer.readInt16BE(this.offset);
        this.offset += 2;
        return result;
      }
      byte() {
        const result = this.buffer[this.offset];
        this.offset++;
        return result;
      }
      int32() {
        const result = this.buffer.readInt32BE(this.offset);
        this.offset += 4;
        return result;
      }
      uint32() {
        const result = this.buffer.readUInt32BE(this.offset);
        this.offset += 4;
        return result;
      }
      string(length) {
        const result = this.buffer.toString(this.encoding, this.offset, this.offset + length);
        this.offset += length;
        return result;
      }
      cstring() {
        const start = this.offset;
        let end = start;
        while (this.buffer[end++]) {
        }
        this.offset = end;
        return this.buffer.toString(this.encoding, start, end - 1);
      }
      bytes(length) {
        const result = this.buffer.slice(this.offset, this.offset + length);
        this.offset += length;
        return result;
      }
    };
    exports.BufferReader = BufferReader;
  }
});

// node_modules/pg-protocol/dist/parser.js
var require_parser = __commonJS({
  "node_modules/pg-protocol/dist/parser.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.Parser = void 0;
    var messages_1 = require_messages();
    var buffer_reader_1 = require_buffer_reader();
    var CODE_LENGTH = 1;
    var LEN_LENGTH = 4;
    var HEADER_LENGTH = CODE_LENGTH + LEN_LENGTH;
    var LATEINIT_LENGTH = -1;
    var emptyBuffer = Buffer.allocUnsafe(0);
    var Parser = class {
      static {
        __name(this, "Parser");
      }
      constructor(opts) {
        this.buffer = emptyBuffer;
        this.bufferLength = 0;
        this.bufferOffset = 0;
        this.reader = new buffer_reader_1.BufferReader();
        if ((opts === null || opts === void 0 ? void 0 : opts.mode) === "binary") {
          throw new Error("Binary mode not supported yet");
        }
        this.mode = (opts === null || opts === void 0 ? void 0 : opts.mode) || "text";
      }
      parse(buffer, callback) {
        this.mergeBuffer(buffer);
        const bufferFullLength = this.bufferOffset + this.bufferLength;
        let offset = this.bufferOffset;
        while (offset + HEADER_LENGTH <= bufferFullLength) {
          const code = this.buffer[offset];
          const length = this.buffer.readUInt32BE(offset + CODE_LENGTH);
          const fullMessageLength = CODE_LENGTH + length;
          if (fullMessageLength + offset <= bufferFullLength) {
            const message = this.handlePacket(offset + HEADER_LENGTH, code, length, this.buffer);
            callback(message);
            offset += fullMessageLength;
          } else {
            break;
          }
        }
        if (offset === bufferFullLength) {
          this.buffer = emptyBuffer;
          this.bufferLength = 0;
          this.bufferOffset = 0;
        } else {
          this.bufferLength = bufferFullLength - offset;
          this.bufferOffset = offset;
        }
      }
      mergeBuffer(buffer) {
        if (this.bufferLength > 0) {
          const newLength = this.bufferLength + buffer.byteLength;
          const newFullLength = newLength + this.bufferOffset;
          if (newFullLength > this.buffer.byteLength) {
            let newBuffer;
            if (newLength <= this.buffer.byteLength && this.bufferOffset >= this.bufferLength) {
              newBuffer = this.buffer;
            } else {
              let newBufferLength = this.buffer.byteLength * 2;
              while (newLength >= newBufferLength) {
                newBufferLength *= 2;
              }
              newBuffer = Buffer.allocUnsafe(newBufferLength);
            }
            this.buffer.copy(newBuffer, 0, this.bufferOffset, this.bufferOffset + this.bufferLength);
            this.buffer = newBuffer;
            this.bufferOffset = 0;
          }
          buffer.copy(this.buffer, this.bufferOffset + this.bufferLength);
          this.bufferLength = newLength;
        } else {
          this.buffer = buffer;
          this.bufferOffset = 0;
          this.bufferLength = buffer.byteLength;
        }
      }
      handlePacket(offset, code, length, bytes) {
        const { reader } = this;
        reader.setBuffer(offset, bytes);
        let message;
        switch (code) {
          case 50:
            message = messages_1.bindComplete;
            break;
          case 49:
            message = messages_1.parseComplete;
            break;
          case 51:
            message = messages_1.closeComplete;
            break;
          case 110:
            message = messages_1.noData;
            break;
          case 115:
            message = messages_1.portalSuspended;
            break;
          case 99:
            message = messages_1.copyDone;
            break;
          case 87:
            message = messages_1.replicationStart;
            break;
          case 73:
            message = messages_1.emptyQuery;
            break;
          case 68:
            message = parseDataRowMessage(reader);
            break;
          case 67:
            message = parseCommandCompleteMessage(reader);
            break;
          case 90:
            message = parseReadyForQueryMessage(reader);
            break;
          case 65:
            message = parseNotificationMessage(reader);
            break;
          case 82:
            message = parseAuthenticationResponse(reader, length);
            break;
          case 83:
            message = parseParameterStatusMessage(reader);
            break;
          case 75:
            message = parseBackendKeyData(reader);
            break;
          case 69:
            message = parseErrorMessage(reader, "error");
            break;
          case 78:
            message = parseErrorMessage(reader, "notice");
            break;
          case 84:
            message = parseRowDescriptionMessage(reader);
            break;
          case 116:
            message = parseParameterDescriptionMessage(reader);
            break;
          case 71:
            message = parseCopyInMessage(reader);
            break;
          case 72:
            message = parseCopyOutMessage(reader);
            break;
          case 100:
            message = parseCopyData(reader, length);
            break;
          default:
            return new messages_1.DatabaseError("received invalid response: " + code.toString(16), length, "error");
        }
        reader.setBuffer(0, emptyBuffer);
        message.length = length;
        return message;
      }
    };
    exports.Parser = Parser;
    var parseReadyForQueryMessage = /* @__PURE__ */ __name((reader) => {
      const status = reader.string(1);
      return new messages_1.ReadyForQueryMessage(LATEINIT_LENGTH, status);
    }, "parseReadyForQueryMessage");
    var parseCommandCompleteMessage = /* @__PURE__ */ __name((reader) => {
      const text2 = reader.cstring();
      return new messages_1.CommandCompleteMessage(LATEINIT_LENGTH, text2);
    }, "parseCommandCompleteMessage");
    var parseCopyData = /* @__PURE__ */ __name((reader, length) => {
      const chunk = reader.bytes(length - 4);
      return new messages_1.CopyDataMessage(LATEINIT_LENGTH, chunk);
    }, "parseCopyData");
    var parseCopyInMessage = /* @__PURE__ */ __name((reader) => parseCopyMessage(reader, "copyInResponse"), "parseCopyInMessage");
    var parseCopyOutMessage = /* @__PURE__ */ __name((reader) => parseCopyMessage(reader, "copyOutResponse"), "parseCopyOutMessage");
    var parseCopyMessage = /* @__PURE__ */ __name((reader, messageName) => {
      const isBinary = reader.byte() !== 0;
      const columnCount = reader.int16();
      const message = new messages_1.CopyResponse(LATEINIT_LENGTH, messageName, isBinary, columnCount);
      for (let i = 0; i < columnCount; i++) {
        message.columnTypes[i] = reader.int16();
      }
      return message;
    }, "parseCopyMessage");
    var parseNotificationMessage = /* @__PURE__ */ __name((reader) => {
      const processId = reader.int32();
      const channel = reader.cstring();
      const payload = reader.cstring();
      return new messages_1.NotificationResponseMessage(LATEINIT_LENGTH, processId, channel, payload);
    }, "parseNotificationMessage");
    var parseRowDescriptionMessage = /* @__PURE__ */ __name((reader) => {
      const fieldCount = reader.int16();
      const message = new messages_1.RowDescriptionMessage(LATEINIT_LENGTH, fieldCount);
      for (let i = 0; i < fieldCount; i++) {
        message.fields[i] = parseField(reader);
      }
      return message;
    }, "parseRowDescriptionMessage");
    var parseField = /* @__PURE__ */ __name((reader) => {
      const name = reader.cstring();
      const tableID = reader.uint32();
      const columnID = reader.int16();
      const dataTypeID = reader.uint32();
      const dataTypeSize = reader.int16();
      const dataTypeModifier = reader.int32();
      const mode = reader.int16() === 0 ? "text" : "binary";
      return new messages_1.Field(name, tableID, columnID, dataTypeID, dataTypeSize, dataTypeModifier, mode);
    }, "parseField");
    var parseParameterDescriptionMessage = /* @__PURE__ */ __name((reader) => {
      const parameterCount = reader.int16();
      const message = new messages_1.ParameterDescriptionMessage(LATEINIT_LENGTH, parameterCount);
      for (let i = 0; i < parameterCount; i++) {
        message.dataTypeIDs[i] = reader.uint32();
      }
      return message;
    }, "parseParameterDescriptionMessage");
    var parseDataRowMessage = /* @__PURE__ */ __name((reader) => {
      const fieldCount = reader.int16();
      const fields = new Array(fieldCount);
      for (let i = 0; i < fieldCount; i++) {
        const len = reader.int32();
        fields[i] = len === -1 ? null : reader.string(len);
      }
      return new messages_1.DataRowMessage(LATEINIT_LENGTH, fields);
    }, "parseDataRowMessage");
    var parseParameterStatusMessage = /* @__PURE__ */ __name((reader) => {
      const name = reader.cstring();
      const value = reader.cstring();
      return new messages_1.ParameterStatusMessage(LATEINIT_LENGTH, name, value);
    }, "parseParameterStatusMessage");
    var parseBackendKeyData = /* @__PURE__ */ __name((reader) => {
      const processID = reader.int32();
      const secretKey = reader.int32();
      return new messages_1.BackendKeyDataMessage(LATEINIT_LENGTH, processID, secretKey);
    }, "parseBackendKeyData");
    var parseAuthenticationResponse = /* @__PURE__ */ __name((reader, length) => {
      const code = reader.int32();
      const message = {
        name: "authenticationOk",
        length
      };
      switch (code) {
        case 0:
          break;
        case 3:
          if (message.length === 8) {
            message.name = "authenticationCleartextPassword";
          }
          break;
        case 5:
          if (message.length === 12) {
            message.name = "authenticationMD5Password";
            const salt = reader.bytes(4);
            return new messages_1.AuthenticationMD5Password(LATEINIT_LENGTH, salt);
          }
          break;
        case 10:
          {
            message.name = "authenticationSASL";
            message.mechanisms = [];
            let mechanism;
            do {
              mechanism = reader.cstring();
              if (mechanism) {
                message.mechanisms.push(mechanism);
              }
            } while (mechanism);
          }
          break;
        case 11:
          message.name = "authenticationSASLContinue";
          message.data = reader.string(length - 8);
          break;
        case 12:
          message.name = "authenticationSASLFinal";
          message.data = reader.string(length - 8);
          break;
        default:
          throw new Error("Unknown authenticationOk message type " + code);
      }
      return message;
    }, "parseAuthenticationResponse");
    var parseErrorMessage = /* @__PURE__ */ __name((reader, name) => {
      const fields = {};
      let fieldType = reader.string(1);
      while (fieldType !== "\0") {
        fields[fieldType] = reader.cstring();
        fieldType = reader.string(1);
      }
      const messageValue = fields.M;
      const message = name === "notice" ? new messages_1.NoticeMessage(LATEINIT_LENGTH, messageValue) : new messages_1.DatabaseError(messageValue, LATEINIT_LENGTH, name);
      message.severity = fields.S;
      message.code = fields.C;
      message.detail = fields.D;
      message.hint = fields.H;
      message.position = fields.P;
      message.internalPosition = fields.p;
      message.internalQuery = fields.q;
      message.where = fields.W;
      message.schema = fields.s;
      message.table = fields.t;
      message.column = fields.c;
      message.dataType = fields.d;
      message.constraint = fields.n;
      message.file = fields.F;
      message.line = fields.L;
      message.routine = fields.R;
      return message;
    }, "parseErrorMessage");
  }
});

// node_modules/pg-protocol/dist/index.js
var require_dist = __commonJS({
  "node_modules/pg-protocol/dist/index.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.DatabaseError = exports.serialize = void 0;
    exports.parse = parse2;
    var messages_1 = require_messages();
    Object.defineProperty(exports, "DatabaseError", { enumerable: true, get: /* @__PURE__ */ __name(function() {
      return messages_1.DatabaseError;
    }, "get") });
    var serializer_1 = require_serializer();
    Object.defineProperty(exports, "serialize", { enumerable: true, get: /* @__PURE__ */ __name(function() {
      return serializer_1.serialize;
    }, "get") });
    var parser_1 = require_parser();
    function parse2(stream, callback) {
      const parser = new parser_1.Parser();
      stream.on("data", (buffer) => parser.parse(buffer, callback));
      return new Promise((resolve) => stream.on("end", () => resolve()));
    }
    __name(parse2, "parse");
  }
});

// node-built-in-modules:net
import libDefault7 from "net";
var require_net = __commonJS({
  "node-built-in-modules:net"(exports, module) {
    module.exports = libDefault7;
  }
});

// node-built-in-modules:tls
import libDefault8 from "tls";
var require_tls = __commonJS({
  "node-built-in-modules:tls"(exports, module) {
    module.exports = libDefault8;
  }
});

// node_modules/pg-cloudflare/dist/index.js
var require_dist2 = __commonJS({
  "node_modules/pg-cloudflare/dist/index.js"(exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.CloudflareSocket = void 0;
    var events_1 = require_events();
    var CloudflareSocket = class extends events_1.EventEmitter {
      static {
        __name(this, "CloudflareSocket");
      }
      constructor(ssl) {
        super();
        this.ssl = ssl;
        this.writable = false;
        this.destroyed = false;
        this._upgrading = false;
        this._upgraded = false;
        this._cfSocket = null;
        this._cfWriter = null;
        this._cfReader = null;
      }
      setNoDelay() {
        return this;
      }
      setKeepAlive() {
        return this;
      }
      ref() {
        return this;
      }
      unref() {
        return this;
      }
      async connect(port, host, connectListener) {
        try {
          log("connecting");
          if (connectListener)
            this.once("connect", connectListener);
          const options = this.ssl ? { secureTransport: "starttls" } : {};
          const mod = await import("cloudflare:sockets");
          const connect = mod.connect;
          this._cfSocket = connect(`${host}:${port}`, options);
          this._cfWriter = this._cfSocket.writable.getWriter();
          this._addClosedHandler();
          this._cfReader = this._cfSocket.readable.getReader();
          if (this.ssl) {
            this._listenOnce().catch((e) => this.emit("error", e));
          } else {
            this._listen().catch((e) => this.emit("error", e));
          }
          await this._cfWriter.ready;
          log("socket ready");
          this.writable = true;
          this.emit("connect");
          return this;
        } catch (e) {
          this.emit("error", e);
        }
      }
      async _listen() {
        while (true) {
          log("awaiting receive from CF socket");
          const { done: done2, value } = await this._cfReader.read();
          log("CF socket received:", done2, value);
          if (done2) {
            log("done");
            break;
          }
          this.emit("data", Buffer.from(value));
        }
      }
      async _listenOnce() {
        log("awaiting first receive from CF socket");
        const { done: done2, value } = await this._cfReader.read();
        log("First CF socket received:", done2, value);
        this.emit("data", Buffer.from(value));
      }
      write(data, encoding = "utf8", callback = () => {
      }) {
        if (data.length === 0)
          return callback();
        if (typeof data === "string")
          data = Buffer.from(data, encoding);
        log("sending data direct:", data);
        this._cfWriter.write(data).then(() => {
          log("data sent");
          callback();
        }, (err) => {
          log("send error", err);
          callback(err);
        });
        return true;
      }
      end(data = Buffer.alloc(0), encoding = "utf8", callback = () => {
      }) {
        log("ending CF socket");
        this.write(data, encoding, (err) => {
          this._cfSocket.close();
          if (callback)
            callback(err);
        });
        return this;
      }
      destroy(reason) {
        log("destroying CF socket", reason);
        this.destroyed = true;
        return this.end();
      }
      startTls(options) {
        if (this._upgraded) {
          this.emit("error", "Cannot call `startTls()` more than once on a socket");
          return;
        }
        this._cfWriter.releaseLock();
        this._cfReader.releaseLock();
        this._upgrading = true;
        this._cfSocket = this._cfSocket.startTls(options);
        this._cfWriter = this._cfSocket.writable.getWriter();
        this._cfReader = this._cfSocket.readable.getReader();
        this._addClosedHandler();
        this._listen().catch((e) => this.emit("error", e));
      }
      _addClosedHandler() {
        this._cfSocket.closed.then(() => {
          if (!this._upgrading) {
            log("CF socket closed");
            this._cfSocket = null;
            this.emit("close");
          } else {
            this._upgrading = false;
            this._upgraded = true;
          }
        }).catch((e) => this.emit("error", e));
      }
    };
    exports.CloudflareSocket = CloudflareSocket;
    var debug = false;
    function dump(data) {
      if (data instanceof Uint8Array || data instanceof ArrayBuffer) {
        const buf = data instanceof Uint8Array ? Buffer.from(data) : Buffer.from(data);
        const hex = buf.toString("hex");
        const str = new TextDecoder().decode(data);
        return `
>>> STR: "${str.replace(/\n/g, "\\n")}"
>>> HEX: ${hex}
`;
      } else {
        return data;
      }
    }
    __name(dump, "dump");
    function log(...args) {
      debug && console.log(...args.map(dump));
    }
    __name(log, "log");
  }
});

// node_modules/pg/lib/stream.js
var require_stream = __commonJS({
  "node_modules/pg/lib/stream.js"(exports, module) {
    var { getStream, getSecureStream } = getStreamFuncs();
    module.exports = {
      /**
       * Get a socket stream compatible with the current runtime environment.
       * @returns {Duplex}
       */
      getStream,
      /**
       * Get a TLS secured socket, compatible with the current environment,
       * using the socket and other settings given in `options`.
       * @returns {Duplex}
       */
      getSecureStream
    };
    function getNodejsStreamFuncs() {
      function getStream2(ssl) {
        const net = require_net();
        return new net.Socket();
      }
      __name(getStream2, "getStream");
      function getSecureStream2(options) {
        const tls = require_tls();
        return tls.connect(options);
      }
      __name(getSecureStream2, "getSecureStream");
      return {
        getStream: getStream2,
        getSecureStream: getSecureStream2
      };
    }
    __name(getNodejsStreamFuncs, "getNodejsStreamFuncs");
    function getCloudflareStreamFuncs() {
      function getStream2(ssl) {
        const { CloudflareSocket } = require_dist2();
        return new CloudflareSocket(ssl);
      }
      __name(getStream2, "getStream");
      function getSecureStream2(options) {
        options.socket.startTls(options);
        return options.socket;
      }
      __name(getSecureStream2, "getSecureStream");
      return {
        getStream: getStream2,
        getSecureStream: getSecureStream2
      };
    }
    __name(getCloudflareStreamFuncs, "getCloudflareStreamFuncs");
    function isCloudflareRuntime() {
      if (typeof navigator === "object" && navigator !== null && true) {
        return true;
      }
      if (typeof Response === "function") {
        const resp = new Response(null, { cf: { thing: true } });
        if (typeof resp.cf === "object" && resp.cf !== null && resp.cf.thing) {
          return true;
        }
      }
      return false;
    }
    __name(isCloudflareRuntime, "isCloudflareRuntime");
    function getStreamFuncs() {
      if (isCloudflareRuntime()) {
        return getCloudflareStreamFuncs();
      }
      return getNodejsStreamFuncs();
    }
    __name(getStreamFuncs, "getStreamFuncs");
  }
});

// node_modules/pg/lib/connection.js
var require_connection = __commonJS({
  "node_modules/pg/lib/connection.js"(exports, module) {
    "use strict";
    var EventEmitter = require_events().EventEmitter;
    var { parse: parse2, serialize: serialize2 } = require_dist();
    var stream = require_stream();
    var { getStream } = stream;
    var flushBuffer = serialize2.flush();
    var syncBuffer = serialize2.sync();
    var endBuffer = serialize2.end();
    var Connection2 = class extends EventEmitter {
      static {
        __name(this, "Connection");
      }
      constructor(config) {
        super();
        config = config || {};
        this.stream = config.stream || getStream(config.ssl);
        if (typeof this.stream === "function") {
          this.stream = this.stream(config);
        }
        this._keepAlive = config.keepAlive;
        this._keepAliveInitialDelayMillis = config.keepAliveInitialDelayMillis;
        this.parsedStatements = {};
        this.submittedNamedStatements = {};
        this.ssl = config.ssl || false;
        this.sslNegotiation = config.sslNegotiation || "postgres";
        this._ending = false;
        this._emitMessage = false;
        const self = this;
        this.on("newListener", function(eventName) {
          if (eventName === "message") {
            self._emitMessage = true;
          }
        });
      }
      connect(port, host) {
        const self = this;
        this._connecting = true;
        this.stream.setNoDelay(true);
        this.stream.connect(port, host);
        this.stream.once("connect", function() {
          if (self._keepAlive) {
            self.stream.setKeepAlive(true, self._keepAliveInitialDelayMillis);
          }
          self.emit("connect");
        });
        const reportStreamError = /* @__PURE__ */ __name(function(error) {
          if (self._ending && (error.code === "ECONNRESET" || error.code === "EPIPE")) {
            return;
          }
          self.emit("error", error);
        }, "reportStreamError");
        this.stream.on("error", reportStreamError);
        this.stream.on("close", function() {
          self.emit("end");
        });
        if (!this.ssl) {
          return this.attachListeners(this.stream);
        }
        if (this.sslNegotiation === "direct") {
          return this.stream.once("connect", function() {
            self.upgradeToSSL(host, reportStreamError);
          });
        }
        this.stream.once("data", function(buffer) {
          const responseCode = buffer.toString("utf8");
          switch (responseCode) {
            case "S":
              break;
            case "N":
              self.stream.end();
              return self.emit("error", new Error("The server does not support SSL connections"));
            default:
              self.stream.end();
              return self.emit("error", new Error("There was an error establishing an SSL connection"));
          }
          self.upgradeToSSL(host, reportStreamError);
        });
      }
      upgradeToSSL(host, reportStreamError) {
        const self = this;
        const options = {
          socket: self.stream
        };
        if (self.ssl !== true) {
          Object.assign(options, self.ssl);
          if ("key" in self.ssl) {
            options.key = self.ssl.key;
          }
        }
        if (self.sslNegotiation === "direct") {
          options.ALPNProtocols = ["postgresql"];
        }
        const net = require_net();
        if (net.isIP && net.isIP(host) === 0) {
          options.servername = host;
        }
        try {
          self.stream = stream.getSecureStream(options);
        } catch (err) {
          return self.emit("error", err);
        }
        self.attachListeners(self.stream);
        self.stream.on("error", reportStreamError);
        self.emit("sslconnect");
      }
      attachListeners(stream2) {
        parse2(stream2, (msg) => {
          const eventName = msg.name === "error" ? "errorMessage" : msg.name;
          if (this._emitMessage) {
            this.emit("message", msg);
          }
          this.emit(eventName, msg);
        });
      }
      requestSsl() {
        this.stream.write(serialize2.requestSsl());
      }
      startup(config) {
        this.stream.write(serialize2.startup(config));
      }
      cancel(processID, secretKey) {
        this._send(serialize2.cancel(processID, secretKey));
      }
      password(password) {
        this._send(serialize2.password(password));
      }
      sendSASLInitialResponseMessage(mechanism, initialResponse) {
        this._send(serialize2.sendSASLInitialResponseMessage(mechanism, initialResponse));
      }
      sendSCRAMClientFinalMessage(additionalData) {
        this._send(serialize2.sendSCRAMClientFinalMessage(additionalData));
      }
      _send(buffer) {
        if (!this.stream.writable) {
          return false;
        }
        return this.stream.write(buffer);
      }
      query(text2) {
        this._send(serialize2.query(text2));
      }
      // send parse message
      parse(query) {
        this._send(serialize2.parse(query));
      }
      // send bind message
      bind(config) {
        this._send(serialize2.bind(config));
      }
      // send execute message
      execute(config) {
        this._send(serialize2.execute(config));
      }
      flush() {
        if (this.stream.writable) {
          this.stream.write(flushBuffer);
        }
      }
      sync() {
        this._ending = true;
        this._send(syncBuffer);
      }
      ref() {
        this.stream.ref();
      }
      unref() {
        this.stream.unref();
      }
      end() {
        this._ending = true;
        if (!this._connecting || !this.stream.writable) {
          this.stream.end();
          return;
        }
        return this.stream.write(endBuffer, () => {
          this.stream.end();
        });
      }
      close(msg) {
        this._send(serialize2.close(msg));
      }
      describe(msg) {
        this._send(serialize2.describe(msg));
      }
      sendCopyFromChunk(chunk) {
        this._send(serialize2.copyData(chunk));
      }
      endCopyFrom() {
        this._send(serialize2.copyDone());
      }
      sendCopyFail(msg) {
        this._send(serialize2.copyFail(msg));
      }
    };
    module.exports = Connection2;
  }
});

// node-built-in-modules:path
import libDefault9 from "path";
var require_path = __commonJS({
  "node-built-in-modules:path"(exports, module) {
    module.exports = libDefault9;
  }
});

// node-built-in-modules:stream
import libDefault10 from "stream";
var require_stream2 = __commonJS({
  "node-built-in-modules:stream"(exports, module) {
    module.exports = libDefault10;
  }
});

// node-built-in-modules:string_decoder
import libDefault11 from "string_decoder";
var require_string_decoder = __commonJS({
  "node-built-in-modules:string_decoder"(exports, module) {
    module.exports = libDefault11;
  }
});

// node_modules/split2/index.js
var require_split2 = __commonJS({
  "node_modules/split2/index.js"(exports, module) {
    "use strict";
    var { Transform } = require_stream2();
    var { StringDecoder } = require_string_decoder();
    var kLast = /* @__PURE__ */ Symbol("last");
    var kDecoder = /* @__PURE__ */ Symbol("decoder");
    function transform(chunk, enc, cb) {
      let list2;
      if (this.overflow) {
        const buf = this[kDecoder].write(chunk);
        list2 = buf.split(this.matcher);
        if (list2.length === 1) return cb();
        list2.shift();
        this.overflow = false;
      } else {
        this[kLast] += this[kDecoder].write(chunk);
        list2 = this[kLast].split(this.matcher);
      }
      this[kLast] = list2.pop();
      for (let i = 0; i < list2.length; i++) {
        try {
          push(this, this.mapper(list2[i]));
        } catch (error) {
          return cb(error);
        }
      }
      this.overflow = this[kLast].length > this.maxLength;
      if (this.overflow && !this.skipOverflow) {
        cb(new Error("maximum buffer reached"));
        return;
      }
      cb();
    }
    __name(transform, "transform");
    function flush(cb) {
      this[kLast] += this[kDecoder].end();
      if (this[kLast]) {
        try {
          push(this, this.mapper(this[kLast]));
        } catch (error) {
          return cb(error);
        }
      }
      cb();
    }
    __name(flush, "flush");
    function push(self, val) {
      if (val !== void 0) {
        self.push(val);
      }
    }
    __name(push, "push");
    function noop(incoming) {
      return incoming;
    }
    __name(noop, "noop");
    function split(matcher, mapper, options) {
      matcher = matcher || /\r?\n/;
      mapper = mapper || noop;
      options = options || {};
      switch (arguments.length) {
        case 1:
          if (typeof matcher === "function") {
            mapper = matcher;
            matcher = /\r?\n/;
          } else if (typeof matcher === "object" && !(matcher instanceof RegExp) && !matcher[Symbol.split]) {
            options = matcher;
            matcher = /\r?\n/;
          }
          break;
        case 2:
          if (typeof matcher === "function") {
            options = mapper;
            mapper = matcher;
            matcher = /\r?\n/;
          } else if (typeof mapper === "object") {
            options = mapper;
            mapper = noop;
          }
      }
      options = Object.assign({}, options);
      options.autoDestroy = true;
      options.transform = transform;
      options.flush = flush;
      options.readableObjectMode = true;
      const stream = new Transform(options);
      stream[kLast] = "";
      stream[kDecoder] = new StringDecoder("utf8");
      stream.matcher = matcher;
      stream.mapper = mapper;
      stream.maxLength = options.maxLength;
      stream.skipOverflow = options.skipOverflow || false;
      stream.overflow = false;
      stream._destroy = function(err, cb) {
        this._writableState.errorEmitted = false;
        cb(err);
      };
      return stream;
    }
    __name(split, "split");
    module.exports = split;
  }
});

// node_modules/pgpass/lib/helper.js
var require_helper = __commonJS({
  "node_modules/pgpass/lib/helper.js"(exports, module) {
    "use strict";
    var path = require_path();
    var Stream = require_stream2().Stream;
    var split = require_split2();
    var util = require_util();
    var defaultPort = 5432;
    var isWin = process.platform === "win32";
    var warnStream = process.stderr;
    var S_IRWXG = 56;
    var S_IRWXO = 7;
    var S_IFMT = 61440;
    var S_IFREG = 32768;
    function isRegFile(mode) {
      return (mode & S_IFMT) == S_IFREG;
    }
    __name(isRegFile, "isRegFile");
    var fieldNames = ["host", "port", "database", "user", "password"];
    var nrOfFields = fieldNames.length;
    var passKey = fieldNames[nrOfFields - 1];
    function warn() {
      var isWritable = warnStream instanceof Stream && true === warnStream.writable;
      if (isWritable) {
        var args = Array.prototype.slice.call(arguments).concat("\n");
        warnStream.write(util.format.apply(util, args));
      }
    }
    __name(warn, "warn");
    Object.defineProperty(module.exports, "isWin", {
      get: /* @__PURE__ */ __name(function() {
        return isWin;
      }, "get"),
      set: /* @__PURE__ */ __name(function(val) {
        isWin = val;
      }, "set")
    });
    module.exports.warnTo = function(stream) {
      var old = warnStream;
      warnStream = stream;
      return old;
    };
    module.exports.getFileName = function(rawEnv) {
      var env = rawEnv || process.env;
      var file = env.PGPASSFILE || (isWin ? path.join(env.APPDATA || "./", "postgresql", "pgpass.conf") : path.join(env.HOME || "./", ".pgpass"));
      return file;
    };
    module.exports.usePgPass = function(stats, fname) {
      if (Object.prototype.hasOwnProperty.call(process.env, "PGPASSWORD")) {
        return false;
      }
      if (isWin) {
        return true;
      }
      fname = fname || "<unkn>";
      if (!isRegFile(stats.mode)) {
        warn('WARNING: password file "%s" is not a plain file', fname);
        return false;
      }
      if (stats.mode & (S_IRWXG | S_IRWXO)) {
        warn('WARNING: password file "%s" has group or world access; permissions should be u=rw (0600) or less', fname);
        return false;
      }
      return true;
    };
    var matcher = module.exports.match = function(connInfo, entry) {
      return fieldNames.slice(0, -1).reduce(function(prev, field, idx) {
        if (idx == 1) {
          if (Number(connInfo[field] || defaultPort) === Number(entry[field])) {
            return prev && true;
          }
        }
        return prev && (entry[field] === "*" || entry[field] === connInfo[field]);
      }, true);
    };
    module.exports.getPassword = function(connInfo, stream, cb) {
      var pass;
      var lineStream = stream.pipe(split());
      function onLine(line) {
        var entry = parseLine(line);
        if (entry && isValidEntry(entry) && matcher(connInfo, entry)) {
          pass = entry[passKey];
          lineStream.end();
        }
      }
      __name(onLine, "onLine");
      var onEnd = /* @__PURE__ */ __name(function() {
        stream.destroy();
        cb(pass);
      }, "onEnd");
      var onErr = /* @__PURE__ */ __name(function(err) {
        stream.destroy();
        warn("WARNING: error on reading file: %s", err);
        cb(void 0);
      }, "onErr");
      stream.on("error", onErr);
      lineStream.on("data", onLine).on("end", onEnd).on("error", onErr);
    };
    var parseLine = module.exports.parseLine = function(line) {
      if (line.length < 11 || line.match(/^\s+#/)) {
        return null;
      }
      var curChar = "";
      var prevChar = "";
      var fieldIdx = 0;
      var startIdx = 0;
      var endIdx = 0;
      var obj = {};
      var isLastField = false;
      var addToObj = /* @__PURE__ */ __name(function(idx, i0, i1) {
        var field = line.substring(i0, i1);
        if (!Object.hasOwnProperty.call(process.env, "PGPASS_NO_DEESCAPE")) {
          field = field.replace(/\\([:\\])/g, "$1");
        }
        obj[fieldNames[idx]] = field;
      }, "addToObj");
      for (var i = 0; i < line.length - 1; i += 1) {
        curChar = line.charAt(i + 1);
        prevChar = line.charAt(i);
        isLastField = fieldIdx == nrOfFields - 1;
        if (isLastField) {
          addToObj(fieldIdx, startIdx);
          break;
        }
        if (i >= 0 && curChar == ":" && prevChar !== "\\") {
          addToObj(fieldIdx, startIdx, i + 1);
          startIdx = i + 2;
          fieldIdx += 1;
        }
      }
      obj = Object.keys(obj).length === nrOfFields ? obj : null;
      return obj;
    };
    var isValidEntry = module.exports.isValidEntry = function(entry) {
      var rules = {
        // host
        0: function(x) {
          return x.length > 0;
        },
        // port
        1: function(x) {
          if (x === "*") {
            return true;
          }
          x = Number(x);
          return isFinite(x) && x > 0 && x < 9007199254740992 && Math.floor(x) === x;
        },
        // database
        2: function(x) {
          return x.length > 0;
        },
        // username
        3: function(x) {
          return x.length > 0;
        },
        // password
        4: function(x) {
          return x.length > 0;
        }
      };
      for (var idx = 0; idx < fieldNames.length; idx += 1) {
        var rule = rules[idx];
        var value = entry[fieldNames[idx]] || "";
        var res = rule(value);
        if (!res) {
          return false;
        }
      }
      return true;
    };
  }
});

// node_modules/pgpass/lib/index.js
var require_lib = __commonJS({
  "node_modules/pgpass/lib/index.js"(exports, module) {
    "use strict";
    var path = require_path();
    var fs = require_fs();
    var helper = require_helper();
    module.exports = function(connInfo, cb) {
      var file = helper.getFileName();
      fs.stat(file, function(err, stat) {
        if (err || !helper.usePgPass(stat, file)) {
          return cb(void 0);
        }
        var st = fs.createReadStream(file);
        helper.getPassword(connInfo, st, cb);
      });
    };
    module.exports.warnTo = helper.warnTo;
  }
});

// node_modules/pg/lib/client.js
var require_client = __commonJS({
  "node_modules/pg/lib/client.js"(exports, module) {
    var EventEmitter = require_events().EventEmitter;
    var utils = require_utils();
    var nodeUtils = require_util();
    var sasl = require_sasl();
    var TypeOverrides2 = require_type_overrides();
    var ConnectionParameters = require_connection_parameters();
    var Query2 = require_query();
    var defaults2 = require_defaults();
    var Connection2 = require_connection();
    var crypto2 = require_utils2();
    var activeQueryDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "Client.activeQuery is deprecated and will be removed in pg@9.0"
    );
    var queryQueueDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "Client.queryQueue is deprecated and will be removed in pg@9.0."
    );
    var pgPassDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "pgpass support is deprecated and will be removed in pg@9.0. You can provide an async function as the password property to the Client/Pool constructor that returns a password instead. Within this function you can call the pgpass module in your own code."
    );
    var byoPromiseDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "Passing a custom Promise implementation to the Client/Pool constructor is deprecated and will be removed in pg@9.0."
    );
    var queryQueueLengthDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "Calling client.query() when the client is already executing a query is deprecated and will be removed in pg@9.0. Use async/await or an external async flow control mechanism instead."
    );
    function coerceNumberOrDefault(value, defaultValue) {
      if (typeof value === "number") {
        return Number.isFinite(value) ? value : defaultValue;
      }
      if (typeof value === "string" && value.trim() !== "") {
        const n = Number(value);
        return Number.isFinite(n) ? n : defaultValue;
      }
      return defaultValue;
    }
    __name(coerceNumberOrDefault, "coerceNumberOrDefault");
    var Client2 = class extends EventEmitter {
      static {
        __name(this, "Client");
      }
      constructor(config) {
        super();
        this.connectionParameters = new ConnectionParameters(config);
        this.user = this.connectionParameters.user;
        this.database = this.connectionParameters.database;
        this.port = this.connectionParameters.port;
        this.host = this.connectionParameters.host;
        Object.defineProperty(this, "password", {
          configurable: true,
          enumerable: false,
          writable: true,
          value: this.connectionParameters.password
        });
        this.replication = this.connectionParameters.replication;
        const c = config || {};
        if (c.Promise) {
          byoPromiseDeprecationNotice();
        }
        this._Promise = c.Promise || global.Promise;
        this._types = new TypeOverrides2(c.types);
        this._ending = false;
        this._ended = false;
        this._connecting = false;
        this._connected = false;
        this._connectionError = false;
        this._queryable = true;
        this._activeQuery = null;
        this._txStatus = null;
        this.enableChannelBinding = Boolean(c.enableChannelBinding);
        this.scramMaxIterations = coerceNumberOrDefault(c.scramMaxIterations, sasl.DEFAULT_MAX_SCRAM_ITERATIONS);
        this.connection = c.connection || new Connection2({
          stream: c.stream,
          ssl: this.connectionParameters.ssl,
          sslNegotiation: this.connectionParameters.sslnegotiation,
          keepAlive: c.keepAlive || false,
          keepAliveInitialDelayMillis: c.keepAliveInitialDelayMillis || 0,
          encoding: this.connectionParameters.client_encoding || "utf8"
        });
        this._queryQueue = [];
        this._sentQueryQueue = [];
        this.pipeline = Boolean(c.pipeline);
        this.binary = c.binary || defaults2.binary;
        this.processID = null;
        this.secretKey = null;
        this.ssl = this.connectionParameters.ssl || false;
        this.sslNegotiation = this.connectionParameters.sslnegotiation || "postgres";
        if (this.ssl && this.ssl.key) {
          Object.defineProperty(this.ssl, "key", {
            enumerable: false
          });
        }
        this._connectionTimeoutMillis = c.connectionTimeoutMillis || 0;
      }
      get activeQuery() {
        activeQueryDeprecationNotice();
        return this._activeQuery;
      }
      set activeQuery(val) {
        activeQueryDeprecationNotice();
        this._activeQuery = val;
      }
      _getActiveQuery() {
        return this._activeQuery;
      }
      _errorAllQueries(err) {
        const enqueueError = /* @__PURE__ */ __name((query) => {
          process.nextTick(() => {
            query.handleError(err, this.connection);
          });
        }, "enqueueError");
        const activeQuery = this._getActiveQuery();
        if (activeQuery) {
          enqueueError(activeQuery);
          this._activeQuery = null;
        }
        this._sentQueryQueue.forEach(enqueueError);
        this._sentQueryQueue.length = 0;
        this._queryQueue.forEach(enqueueError);
        this._queryQueue.length = 0;
      }
      _connect(callback) {
        const self = this;
        const con = this.connection;
        this._connectionCallback = callback;
        if (this._connecting || this._connected) {
          const err = new Error("Client has already been connected. You cannot reuse a client.");
          process.nextTick(() => {
            callback(err);
          });
          return;
        }
        this._connecting = true;
        if (this._connectionTimeoutMillis > 0) {
          this.connectionTimeoutHandle = setTimeout(() => {
            con._ending = true;
            con.stream.destroy(new Error("timeout expired"));
          }, this._connectionTimeoutMillis);
          if (this.connectionTimeoutHandle.unref) {
            this.connectionTimeoutHandle.unref();
          }
        }
        if (this.host && this.host.indexOf("/") === 0) {
          con.connect(this.host + "/.s.PGSQL." + this.port);
        } else {
          con.connect(this.port, this.host);
        }
        con.on("connect", function() {
          if (self.ssl) {
            if (self.sslNegotiation !== "direct") {
              con.requestSsl();
            }
          } else {
            con.startup(self.getStartupConf());
          }
        });
        con.on("sslconnect", function() {
          con.startup(self.getStartupConf());
        });
        this._attachListeners(con);
        con.once("end", () => {
          const error = this._ending ? new Error("Connection terminated") : new Error("Connection terminated unexpectedly");
          clearTimeout(this.connectionTimeoutHandle);
          this._errorAllQueries(error);
          this._ended = true;
          if (!this._ending) {
            if (this._connecting && !this._connectionError) {
              if (this._connectionCallback) {
                this._connectionCallback(error);
              } else {
                this._handleErrorEvent(error);
              }
            } else if (!this._connectionError) {
              this._handleErrorEvent(error);
            }
          }
          process.nextTick(() => {
            this.emit("end");
          });
        });
      }
      connect(callback) {
        if (callback) {
          this._connect(callback);
          return;
        }
        return new this._Promise((resolve, reject) => {
          this._connect((error) => {
            if (error) {
              reject(error);
            } else {
              resolve(this);
            }
          });
        });
      }
      _attachListeners(con) {
        con.on("authenticationCleartextPassword", this._handleAuthCleartextPassword.bind(this));
        con.on("authenticationMD5Password", this._handleAuthMD5Password.bind(this));
        con.on("authenticationSASL", this._handleAuthSASL.bind(this));
        con.on("authenticationSASLContinue", this._handleAuthSASLContinue.bind(this));
        con.on("authenticationSASLFinal", this._handleAuthSASLFinal.bind(this));
        con.on("backendKeyData", this._handleBackendKeyData.bind(this));
        con.on("error", this._handleErrorEvent.bind(this));
        con.on("errorMessage", this._handleErrorMessage.bind(this));
        con.on("readyForQuery", this._handleReadyForQuery.bind(this));
        con.on("notice", this._handleNotice.bind(this));
        con.on("rowDescription", this._handleRowDescription.bind(this));
        con.on("dataRow", this._handleDataRow.bind(this));
        con.on("portalSuspended", this._handlePortalSuspended.bind(this));
        con.on("emptyQuery", this._handleEmptyQuery.bind(this));
        con.on("commandComplete", this._handleCommandComplete.bind(this));
        con.on("parseComplete", this._handleParseComplete.bind(this));
        con.on("copyInResponse", this._handleCopyInResponse.bind(this));
        con.on("copyData", this._handleCopyData.bind(this));
        con.on("notification", this._handleNotification.bind(this));
      }
      _getPassword(cb) {
        const con = this.connection;
        if (typeof this.password === "function") {
          this._Promise.resolve().then(() => this.password(this.connectionParameters)).then((pass) => {
            if (pass !== void 0) {
              if (typeof pass !== "string") {
                con.emit("error", new TypeError("Password must be a string"));
                return;
              }
              this.connectionParameters.password = this.password = pass;
            } else {
              this.connectionParameters.password = this.password = null;
            }
            cb();
          }).catch((err) => {
            con.emit("error", err);
          });
        } else if (this.password !== null) {
          cb();
        } else {
          try {
            const pgPass = require_lib();
            pgPass(this.connectionParameters, (pass) => {
              if (void 0 !== pass) {
                pgPassDeprecationNotice();
                this.connectionParameters.password = this.password = pass;
              }
              cb();
            });
          } catch (e) {
            this.emit("error", e);
          }
        }
      }
      _handleAuthCleartextPassword(msg) {
        this._getPassword(() => {
          this.connection.password(this.password);
        });
      }
      _handleAuthMD5Password(msg) {
        this._getPassword(async () => {
          try {
            const hashedPassword = await crypto2.postgresMd5PasswordHash(this.user, this.password, msg.salt);
            this.connection.password(hashedPassword);
          } catch (e) {
            this.emit("error", e);
          }
        });
      }
      _handleAuthSASL(msg) {
        this._getPassword(() => {
          try {
            this.saslSession = sasl.startSession(
              msg.mechanisms,
              this.enableChannelBinding && this.connection.stream,
              this.scramMaxIterations
            );
            this.connection.sendSASLInitialResponseMessage(this.saslSession.mechanism, this.saslSession.response);
          } catch (err) {
            this.connection.emit("error", err);
          }
        });
      }
      async _handleAuthSASLContinue(msg) {
        try {
          await sasl.continueSession(
            this.saslSession,
            this.password,
            msg.data,
            this.enableChannelBinding && this.connection.stream
          );
          this.connection.sendSCRAMClientFinalMessage(this.saslSession.response);
        } catch (err) {
          this.connection.emit("error", err);
        }
      }
      _handleAuthSASLFinal(msg) {
        try {
          sasl.finalizeSession(this.saslSession, msg.data);
          this.saslSession = null;
        } catch (err) {
          this.connection.emit("error", err);
        }
      }
      _handleBackendKeyData(msg) {
        this.processID = msg.processID;
        this.secretKey = msg.secretKey;
      }
      _handleReadyForQuery(msg) {
        if (this._connecting) {
          this._connecting = false;
          this._connected = true;
          clearTimeout(this.connectionTimeoutHandle);
          if (this._connectionCallback) {
            this._connectionCallback(null, this);
            this._connectionCallback = null;
          }
          this.emit("connect");
        }
        const activeQuery = this._getActiveQuery();
        this._activeQuery = null;
        this._txStatus = msg?.status ?? null;
        this.readyForQuery = true;
        if (activeQuery) {
          activeQuery.handleReadyForQuery(this.connection);
        }
        this._pulseQueryQueue();
      }
      // if we receive an error event or error message
      // during the connection process we handle it here
      _handleErrorWhileConnecting(err) {
        if (this._connectionError) {
          return;
        }
        this._connectionError = true;
        clearTimeout(this.connectionTimeoutHandle);
        if (this._connectionCallback) {
          return this._connectionCallback(err);
        }
        this.emit("error", err);
      }
      // if we're connected and we receive an error event from the connection
      // this means the socket is dead - do a hard abort of all queries and emit
      // the socket error on the client as well
      _handleErrorEvent(err) {
        if (this._connecting) {
          return this._handleErrorWhileConnecting(err);
        }
        this._queryable = false;
        this._errorAllQueries(err);
        this.emit("error", err);
      }
      // handle error messages from the postgres backend
      _handleErrorMessage(msg) {
        if (this._connecting) {
          return this._handleErrorWhileConnecting(msg);
        }
        const activeQuery = this._getActiveQuery();
        if (!activeQuery) {
          this._handleErrorEvent(msg);
          return;
        }
        this._activeQuery = null;
        if (activeQuery.name) {
          delete this.connection.submittedNamedStatements[activeQuery.name];
        }
        activeQuery.handleError(msg, this.connection);
      }
      _handleRowDescription(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected rowDescription message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleRowDescription(msg);
      }
      _handleDataRow(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected dataRow message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleDataRow(msg);
      }
      _handlePortalSuspended(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected portalSuspended message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handlePortalSuspended(this.connection);
      }
      _handleEmptyQuery(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected emptyQuery message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleEmptyQuery(this.connection);
      }
      _handleCommandComplete(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected commandComplete message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleCommandComplete(msg, this.connection);
      }
      _handleParseComplete() {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected parseComplete message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        if (activeQuery.name) {
          this.connection.parsedStatements[activeQuery.name] = activeQuery.text;
          delete this.connection.submittedNamedStatements[activeQuery.name];
        }
      }
      _handleCopyInResponse(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected copyInResponse message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleCopyInResponse(this.connection);
      }
      _handleCopyData(msg) {
        const activeQuery = this._getActiveQuery();
        if (activeQuery == null) {
          const error = new Error("Received unexpected copyData message from backend.");
          this._handleErrorEvent(error);
          return;
        }
        activeQuery.handleCopyData(msg, this.connection);
      }
      _handleNotification(msg) {
        this.emit("notification", msg);
      }
      _handleNotice(msg) {
        this.emit("notice", msg);
      }
      getStartupConf() {
        const params = this.connectionParameters;
        const data = {
          user: params.user,
          database: params.database
        };
        const appName = params.application_name || params.fallback_application_name;
        if (appName) {
          data.application_name = appName;
        }
        if (params.replication) {
          data.replication = "" + params.replication;
        }
        if (params.statement_timeout) {
          data.statement_timeout = String(parseInt(params.statement_timeout, 10));
        }
        if (params.lock_timeout) {
          data.lock_timeout = String(parseInt(params.lock_timeout, 10));
        }
        if (params.idle_in_transaction_session_timeout) {
          data.idle_in_transaction_session_timeout = String(parseInt(params.idle_in_transaction_session_timeout, 10));
        }
        if (params.options) {
          data.options = params.options;
        }
        return data;
      }
      cancel(client, query) {
        if (client.activeQuery === query) {
          const con = this.connection;
          if (this.host && this.host.indexOf("/") === 0) {
            con.connect(this.host + "/.s.PGSQL." + this.port);
          } else {
            con.connect(this.port, this.host);
          }
          con.on("connect", function() {
            con.cancel(client.processID, client.secretKey);
          });
        } else if (client._queryQueue.indexOf(query) !== -1) {
          client._queryQueue.splice(client._queryQueue.indexOf(query), 1);
        } else if (client._sentQueryQueue.indexOf(query) !== -1) {
          query.callback = () => {
          };
        }
      }
      setTypeParser(oid, format, parseFn) {
        return this._types.setTypeParser(oid, format, parseFn);
      }
      getTypeParser(oid, format) {
        return this._types.getTypeParser(oid, format);
      }
      // escapeIdentifier and escapeLiteral moved to utility functions & exported
      // on PG
      // re-exported here for backwards compatibility
      escapeIdentifier(str) {
        return utils.escapeIdentifier(str);
      }
      escapeLiteral(str) {
        return utils.escapeLiteral(str);
      }
      _pulseQueryQueue() {
        if (this.pipeline) {
          this._pulsePipelinedQueryQueue();
          return;
        }
        if (this.readyForQuery === true) {
          this._activeQuery = this._queryQueue.shift();
          const activeQuery = this._getActiveQuery();
          if (activeQuery) {
            this.readyForQuery = false;
            this.hasExecuted = true;
            const queryError = activeQuery.submit(this.connection);
            if (queryError) {
              process.nextTick(() => {
                activeQuery.handleError(queryError, this.connection);
                this.readyForQuery = true;
                this._pulseQueryQueue();
              });
            }
          } else if (this.hasExecuted) {
            this._activeQuery = null;
            this.emit("drain");
          }
        }
      }
      _pulsePipelinedQueryQueue() {
        if (!this._connected || !this._queryable) {
          return;
        }
        while (this._queryQueue.length > 0) {
          const query = this._queryQueue.shift();
          this.hasExecuted = true;
          const queryError = query.submit(this.connection);
          if (queryError) {
            process.nextTick(() => {
              query.handleError(queryError, this.connection);
            });
            continue;
          }
          this._sentQueryQueue.push(query);
        }
        if (this.readyForQuery && !this._activeQuery && this._sentQueryQueue.length > 0) {
          this._activeQuery = this._sentQueryQueue.shift();
          this.readyForQuery = false;
        }
        if (!this._activeQuery && this._sentQueryQueue.length === 0 && this._queryQueue.length === 0 && this.hasExecuted) {
          this.emit("drain");
        }
      }
      query(config, values, callback) {
        let query;
        let result;
        if (config == null) {
          throw new TypeError("Client was passed a null or undefined query");
        }
        if (typeof config.submit === "function") {
          result = query = config;
          if (!query.callback) {
            if (typeof values === "function") {
              query.callback = values;
            } else if (callback) {
              query.callback = callback;
            }
          }
        } else {
          query = new Query2(config, values, callback);
          if (!query.callback) {
            result = new this._Promise((resolve, reject) => {
              query.callback = (err, res) => err ? reject(err) : resolve(res);
            }).catch((err) => {
              Error.captureStackTrace(err);
              throw err;
            });
          } else if (typeof query.callback !== "function") {
            throw new TypeError("callback is not a function");
          }
        }
        const readTimeout = config.query_timeout || this.connectionParameters.query_timeout;
        if (readTimeout) {
          const queryCallback = query.callback || (() => {
          });
          const readTimeoutTimer = setTimeout(() => {
            const error = new Error("Query read timeout");
            process.nextTick(() => {
              query.handleError(error, this.connection);
            });
            queryCallback(error);
            query.callback = () => {
            };
            const index = this._queryQueue.indexOf(query);
            if (index > -1) {
              this._queryQueue.splice(index, 1);
            } else if (this.pipeline) {
              this.connection.stream.destroy();
              return;
            }
            this._pulseQueryQueue();
          }, readTimeout);
          query.callback = (err, res) => {
            clearTimeout(readTimeoutTimer);
            queryCallback(err, res);
          };
        }
        if (this.binary && !query.binary) {
          query.binary = true;
        }
        if (query._result && !query._result._types) {
          query._result._types = this._types;
        }
        if (!this._queryable) {
          process.nextTick(() => {
            query.handleError(new Error("Client has encountered a connection error and is not queryable"), this.connection);
          });
          return result;
        }
        if (this._ending) {
          process.nextTick(() => {
            query.handleError(new Error("Client was closed and is not queryable"), this.connection);
          });
          return result;
        }
        if (this._queryQueue.length > 0 && !this.pipeline) {
          queryQueueLengthDeprecationNotice();
        }
        this._queryQueue.push(query);
        this._pulseQueryQueue();
        return result;
      }
      ref() {
        this.connection.ref();
      }
      unref() {
        this.connection.unref();
      }
      getTransactionStatus() {
        return this._txStatus;
      }
      end(cb) {
        this._ending = true;
        if (!this.connection._connecting || this._ended) {
          if (cb) {
            cb();
            return;
          } else {
            return this._Promise.resolve();
          }
        }
        if (!this._queryable) {
          this.connection.stream.destroy();
        } else if (this.pipeline && (this._getActiveQuery() || this._sentQueryQueue.length > 0 || this._queryQueue.length > 0)) {
          this.once("drain", () => this.connection.end());
        } else if (this._getActiveQuery()) {
          this.connection.stream.destroy();
        } else {
          this.connection.end();
        }
        if (cb) {
          this.connection.once("end", cb);
        } else {
          return new this._Promise((resolve) => {
            this.connection.once("end", resolve);
          });
        }
      }
      get queryQueue() {
        queryQueueDeprecationNotice();
        return this._queryQueue;
      }
    };
    Client2.Query = Query2;
    module.exports = Client2;
  }
});

// node_modules/pg-pool/index.js
var require_pg_pool = __commonJS({
  "node_modules/pg-pool/index.js"(exports, module) {
    "use strict";
    var EventEmitter = require_events().EventEmitter;
    var NOOP = /* @__PURE__ */ __name(function() {
    }, "NOOP");
    var removeWhere = /* @__PURE__ */ __name((list2, predicate) => {
      const i = list2.findIndex(predicate);
      return i === -1 ? void 0 : list2.splice(i, 1)[0];
    }, "removeWhere");
    var IdleItem = class {
      static {
        __name(this, "IdleItem");
      }
      constructor(client, idleListener, timeoutId) {
        this.client = client;
        this.idleListener = idleListener;
        this.timeoutId = timeoutId;
      }
    };
    var PendingItem = class {
      static {
        __name(this, "PendingItem");
      }
      constructor(callback) {
        this.callback = callback;
      }
    };
    function throwOnDoubleRelease() {
      throw new Error("Release called on client which has already been released to the pool.");
    }
    __name(throwOnDoubleRelease, "throwOnDoubleRelease");
    function promisify(Promise2, callback) {
      if (callback) {
        return { callback, result: void 0 };
      }
      let rej;
      let res;
      const cb = /* @__PURE__ */ __name(function(err, client) {
        err ? rej(err) : res(client);
      }, "cb");
      const result = new Promise2(function(resolve, reject) {
        res = resolve;
        rej = reject;
      }).catch((err) => {
        Error.captureStackTrace(err);
        throw err;
      });
      return { callback: cb, result };
    }
    __name(promisify, "promisify");
    function makeIdleListener(pool, client) {
      return /* @__PURE__ */ __name(function idleListener(err) {
        err.client = client;
        client.removeListener("error", idleListener);
        client.on("error", () => {
          pool.log("additional client error after disconnection due to error", err);
        });
        pool._remove(client);
        pool.emit("error", err, client);
      }, "idleListener");
    }
    __name(makeIdleListener, "makeIdleListener");
    var Pool2 = class extends EventEmitter {
      static {
        __name(this, "Pool");
      }
      constructor(options, Client2) {
        super();
        this.options = Object.assign({}, options);
        if (options != null && "password" in options) {
          Object.defineProperty(this.options, "password", {
            configurable: true,
            enumerable: false,
            writable: true,
            value: options.password
          });
        }
        if (options != null && options.ssl && options.ssl.key) {
          Object.defineProperty(this.options.ssl, "key", {
            enumerable: false
          });
        }
        this.options.max = this.options.max || this.options.poolSize || 10;
        this.options.min = this.options.min || 0;
        this.options.maxUses = this.options.maxUses || Infinity;
        this.options.allowExitOnIdle = this.options.allowExitOnIdle || false;
        this.options.maxLifetimeSeconds = this.options.maxLifetimeSeconds || 0;
        this.log = this.options.log || function() {
        };
        this.Client = this.options.Client || Client2 || require_lib2().Client;
        this.Promise = this.options.Promise || global.Promise;
        if (typeof this.options.idleTimeoutMillis === "undefined") {
          this.options.idleTimeoutMillis = 1e4;
        }
        this._clients = [];
        this._idle = [];
        this._expired = /* @__PURE__ */ new WeakSet();
        this._pendingQueue = [];
        this._endCallback = void 0;
        this.ending = false;
        this.ended = false;
      }
      _promiseTry(f) {
        const Promise2 = this.Promise;
        if (typeof Promise2.try === "function") {
          return Promise2.try(f);
        }
        return new Promise2((resolve) => resolve(f()));
      }
      _isFull() {
        return this._clients.length >= this.options.max;
      }
      _isAboveMin() {
        return this._clients.length > this.options.min;
      }
      _pulseQueue() {
        this.log("pulse queue");
        if (this.ended) {
          this.log("pulse queue ended");
          return;
        }
        if (this.ending) {
          this.log("pulse queue on ending");
          if (this._idle.length) {
            this._idle.slice().map((item) => {
              this._remove(item.client);
            });
          }
          if (!this._clients.length) {
            this.ended = true;
            this._endCallback();
          }
          return;
        }
        if (!this._pendingQueue.length) {
          this.log("no queued requests");
          return;
        }
        if (!this._idle.length && this._isFull()) {
          return;
        }
        const pendingItem = this._pendingQueue.shift();
        if (this._idle.length) {
          const idleItem = this._idle.pop();
          clearTimeout(idleItem.timeoutId);
          const client = idleItem.client;
          client.ref && client.ref();
          const idleListener = idleItem.idleListener;
          return this._acquireClient(client, pendingItem, idleListener, false);
        }
        if (!this._isFull()) {
          return this.newClient(pendingItem);
        }
        throw new Error("unexpected condition");
      }
      _remove(client, callback) {
        const removed = removeWhere(this._idle, (item) => item.client === client);
        if (removed !== void 0) {
          clearTimeout(removed.timeoutId);
        }
        this._clients = this._clients.filter((c) => c !== client);
        const context = this;
        client.end(() => {
          context.emit("remove", client);
          if (typeof callback === "function") {
            callback();
          }
        });
      }
      connect(cb) {
        if (this.ending) {
          const err = new Error("Cannot use a pool after calling end on the pool");
          return cb ? cb(err) : this.Promise.reject(err);
        }
        const response = promisify(this.Promise, cb);
        const result = response.result;
        if (this._isFull() || this._idle.length) {
          if (this._idle.length) {
            process.nextTick(() => this._pulseQueue());
          }
          if (!this.options.connectionTimeoutMillis) {
            this._pendingQueue.push(new PendingItem(response.callback));
            return result;
          }
          const queueCallback = /* @__PURE__ */ __name((err, res, done2) => {
            clearTimeout(tid);
            response.callback(err, res, done2);
          }, "queueCallback");
          const pendingItem = new PendingItem(queueCallback);
          const tid = setTimeout(() => {
            removeWhere(this._pendingQueue, (i) => i.callback === queueCallback);
            pendingItem.timedOut = true;
            response.callback(new Error("timeout exceeded when trying to connect"));
          }, this.options.connectionTimeoutMillis);
          if (tid.unref) {
            tid.unref();
          }
          this._pendingQueue.push(pendingItem);
          return result;
        }
        this.newClient(new PendingItem(response.callback));
        return result;
      }
      newClient(pendingItem) {
        const client = new this.Client(this.options);
        this._clients.push(client);
        const idleListener = makeIdleListener(this, client);
        this.log("checking client timeout");
        let tid;
        let timeoutHit = false;
        if (this.options.connectionTimeoutMillis) {
          tid = setTimeout(() => {
            if (client.connection) {
              this.log("ending client due to timeout");
              timeoutHit = true;
              client.connection.stream.destroy();
            } else if (!client.isConnected()) {
              this.log("ending client due to timeout");
              timeoutHit = true;
              client.end();
            }
          }, this.options.connectionTimeoutMillis);
        }
        this.log("connecting new client");
        client.connect((err) => {
          if (tid) {
            clearTimeout(tid);
          }
          client.on("error", idleListener);
          if (err) {
            this.log("client failed to connect", err);
            this._clients = this._clients.filter((c) => c !== client);
            if (timeoutHit) {
              err = new Error("Connection terminated due to connection timeout", { cause: err });
            }
            this._pulseQueue();
            if (!pendingItem.timedOut) {
              pendingItem.callback(err, void 0, NOOP);
            }
          } else {
            this.log("new client connected");
            if (this.options.onConnect) {
              this._promiseTry(() => this.options.onConnect(client)).then(
                () => {
                  this._afterConnect(client, pendingItem, idleListener);
                },
                (hookErr) => {
                  this._clients = this._clients.filter((c) => c !== client);
                  client.end(() => {
                    this._pulseQueue();
                    if (!pendingItem.timedOut) {
                      pendingItem.callback(hookErr, void 0, NOOP);
                    }
                  });
                }
              );
              return;
            }
            return this._afterConnect(client, pendingItem, idleListener);
          }
        });
      }
      _afterConnect(client, pendingItem, idleListener) {
        if (this.options.maxLifetimeSeconds !== 0) {
          const maxLifetimeTimeout = setTimeout(() => {
            this.log("ending client due to expired lifetime");
            this._expired.add(client);
            const idleIndex = this._idle.findIndex((idleItem) => idleItem.client === client);
            if (idleIndex !== -1) {
              this._acquireClient(
                client,
                new PendingItem((err, client2, clientRelease) => clientRelease()),
                idleListener,
                false
              );
            }
          }, this.options.maxLifetimeSeconds * 1e3);
          maxLifetimeTimeout.unref();
          client.once("end", () => clearTimeout(maxLifetimeTimeout));
        }
        return this._acquireClient(client, pendingItem, idleListener, true);
      }
      // acquire a client for a pending work item
      _acquireClient(client, pendingItem, idleListener, isNew) {
        if (isNew) {
          this.emit("connect", client);
        }
        this.emit("acquire", client);
        client.release = this._releaseOnce(client, idleListener);
        client.removeListener("error", idleListener);
        if (!pendingItem.timedOut) {
          if (isNew && this.options.verify) {
            this.options.verify(client, (err) => {
              if (err) {
                client.release(err);
                return pendingItem.callback(err, void 0, NOOP);
              }
              pendingItem.callback(void 0, client, client.release);
            });
          } else {
            pendingItem.callback(void 0, client, client.release);
          }
        } else {
          if (isNew && this.options.verify) {
            this.options.verify(client, client.release);
          } else {
            client.release();
          }
        }
      }
      // returns a function that wraps _release and throws if called more than once
      _releaseOnce(client, idleListener) {
        let released = false;
        return (err) => {
          if (released) {
            throwOnDoubleRelease();
          }
          released = true;
          this._release(client, idleListener, err);
        };
      }
      // release a client back to the poll, include an error
      // to remove it from the pool
      _release(client, idleListener, err) {
        client.on("error", idleListener);
        client._poolUseCount = (client._poolUseCount || 0) + 1;
        this.emit("release", err, client);
        if (err || this.ending || !client._queryable || client._ending || client._poolUseCount >= this.options.maxUses) {
          if (client._poolUseCount >= this.options.maxUses) {
            this.log("remove expended client");
          }
          return this._remove(client, this._pulseQueue.bind(this));
        }
        const isExpired = this._expired.has(client);
        if (isExpired) {
          this.log("remove expired client");
          this._expired.delete(client);
          return this._remove(client, this._pulseQueue.bind(this));
        }
        let tid;
        if (this.options.idleTimeoutMillis && this._isAboveMin()) {
          tid = setTimeout(() => {
            if (this._isAboveMin()) {
              this.log("remove idle client");
              this._remove(client, this._pulseQueue.bind(this));
            }
          }, this.options.idleTimeoutMillis);
          if (this.options.allowExitOnIdle) {
            tid.unref();
          }
        }
        if (this.options.allowExitOnIdle) {
          client.unref();
        }
        this._idle.push(new IdleItem(client, idleListener, tid));
        this._pulseQueue();
      }
      query(text2, values, cb) {
        if (typeof text2 === "function") {
          const response2 = promisify(this.Promise, text2);
          setImmediate(function() {
            return response2.callback(new Error("Passing a function as the first parameter to pool.query is not supported"));
          });
          return response2.result;
        }
        if (typeof values === "function") {
          cb = values;
          values = void 0;
        }
        const response = promisify(this.Promise, cb);
        cb = response.callback;
        this.connect((err, client) => {
          if (err) {
            return cb(err);
          }
          let clientReleased = false;
          const onError = /* @__PURE__ */ __name((err2) => {
            if (clientReleased) {
              return;
            }
            clientReleased = true;
            client.release(err2);
            cb(err2);
          }, "onError");
          client.once("error", onError);
          this.log("dispatching query");
          try {
            client.query(text2, values, (err2, res) => {
              this.log("query dispatched");
              client.removeListener("error", onError);
              if (clientReleased) {
                return;
              }
              clientReleased = true;
              client.release(err2);
              if (err2) {
                return cb(err2);
              }
              return cb(void 0, res);
            });
          } catch (err2) {
            client.release(err2);
            return cb(err2);
          }
        });
        return response.result;
      }
      end(cb) {
        this.log("ending");
        if (this.ending) {
          const err = new Error("Called end on pool more than once");
          return cb ? cb(err) : this.Promise.reject(err);
        }
        this.ending = true;
        const promised = promisify(this.Promise, cb);
        this._endCallback = promised.callback;
        this._pulseQueue();
        return promised.result;
      }
      get waitingCount() {
        return this._pendingQueue.length;
      }
      get idleCount() {
        return this._idle.length;
      }
      get expiredCount() {
        return this._clients.reduce((acc, client) => acc + (this._expired.has(client) ? 1 : 0), 0);
      }
      get totalCount() {
        return this._clients.length;
      }
    };
    module.exports = Pool2;
  }
});

// node_modules/pg/lib/native/query.js
var require_query2 = __commonJS({
  "node_modules/pg/lib/native/query.js"(exports, module) {
    "use strict";
    var EventEmitter = require_events().EventEmitter;
    var util = require_util();
    var utils = require_utils();
    var NativeQuery = module.exports = function(config, values, callback) {
      EventEmitter.call(this);
      config = utils.normalizeQueryConfig(config, values, callback);
      this.text = config.text;
      this.values = config.values;
      this.name = config.name;
      this.queryMode = config.queryMode;
      this.callback = config.callback;
      this.state = "new";
      this._arrayMode = config.rowMode === "array";
      this._emitRowEvents = false;
      this.on(
        "newListener",
        function(event) {
          if (event === "row") this._emitRowEvents = true;
        }.bind(this)
      );
    };
    util.inherits(NativeQuery, EventEmitter);
    var errorFieldMap = {
      sqlState: "code",
      statementPosition: "position",
      messagePrimary: "message",
      context: "where",
      schemaName: "schema",
      tableName: "table",
      columnName: "column",
      dataTypeName: "dataType",
      constraintName: "constraint",
      sourceFile: "file",
      sourceLine: "line",
      sourceFunction: "routine"
    };
    NativeQuery.prototype.handleError = function(err) {
      const fields = this.native && this.native.pq.resultErrorFields();
      if (fields) {
        for (const key in fields) {
          const normalizedFieldName = errorFieldMap[key] || key;
          err[normalizedFieldName] = fields[key];
        }
      }
      if (this.callback) {
        this.callback(err);
      } else {
        this.emit("error", err);
      }
      this.state = "error";
    };
    NativeQuery.prototype.then = function(onSuccess, onFailure) {
      return this._getPromise().then(onSuccess, onFailure);
    };
    NativeQuery.prototype.catch = function(callback) {
      return this._getPromise().catch(callback);
    };
    NativeQuery.prototype._getPromise = function() {
      if (this._promise) return this._promise;
      this._promise = new Promise(
        function(resolve, reject) {
          this._once("end", resolve);
          this._once("error", reject);
        }.bind(this)
      );
      return this._promise;
    };
    NativeQuery.prototype.submit = function(client) {
      this.state = "running";
      const self = this;
      this.native = client.native;
      client.native.arrayMode = this._arrayMode;
      let after = /* @__PURE__ */ __name(function(err, rows, results) {
        client.native.arrayMode = false;
        setImmediate(function() {
          self.emit("_done");
        });
        if (err) {
          return self.handleError(err);
        }
        if (self._emitRowEvents) {
          if (results.length > 1) {
            rows.forEach((rowOfRows, i) => {
              rowOfRows.forEach((row) => {
                self.emit("row", row, results[i]);
              });
            });
          } else {
            rows.forEach(function(row) {
              self.emit("row", row, results);
            });
          }
        }
        self.state = "end";
        self.emit("end", results);
        if (self.callback) {
          self.callback(null, results);
        }
      }, "after");
      if (process.domain) {
        after = process.domain.bind(after);
      }
      if (this.name) {
        if (this.name.length > 63) {
          console.error("Warning! Postgres only supports 63 characters for query names.");
          console.error("You supplied %s (%s)", this.name, this.name.length);
          console.error("This can cause conflicts and silent errors executing queries");
        }
        const values = (this.values || []).map(utils.prepareValue);
        if (client.namedQueries[this.name]) {
          if (this.text && client.namedQueries[this.name] !== this.text) {
            const err = new Error(`Prepared statements must be unique - '${this.name}' was used for a different statement`);
            return after(err);
          }
          return client.native.execute(this.name, values, after);
        }
        return client.native.prepare(this.name, this.text, values.length, function(err) {
          if (err) return after(err);
          client.namedQueries[self.name] = self.text;
          return self.native.execute(self.name, values, after);
        });
      } else if (this.values) {
        if (!Array.isArray(this.values)) {
          const err = new Error("Query values must be an array");
          return after(err);
        }
        const vals = this.values.map(utils.prepareValue);
        client.native.query(this.text, vals, after);
      } else if (this.queryMode === "extended") {
        client.native.query(this.text, [], after);
      } else {
        client.native.query(this.text, after);
      }
    };
  }
});

// node_modules/pg/lib/native/client.js
var require_client2 = __commonJS({
  "node_modules/pg/lib/native/client.js"(exports, module) {
    var nodeUtils = require_util();
    var Native;
    try {
      Native = __require("pg-native");
    } catch (e) {
      throw e;
    }
    var TypeOverrides2 = require_type_overrides();
    var EventEmitter = require_events().EventEmitter;
    var util = require_util();
    var ConnectionParameters = require_connection_parameters();
    var NativeQuery = require_query2();
    var queryQueueLengthDeprecationNotice = nodeUtils.deprecate(
      () => {
      },
      "Calling client.query() when the client is already executing a query is deprecated and will be removed in pg@9.0. Use async/await or an external async flow control mechanism instead."
    );
    var Client2 = module.exports = function(config) {
      EventEmitter.call(this);
      config = config || {};
      this._Promise = config.Promise || global.Promise;
      this._types = new TypeOverrides2(config.types);
      this.native = new Native({
        types: this._types
      });
      this._queryQueue = [];
      this._ending = false;
      this._connecting = false;
      this._connected = false;
      this._queryable = true;
      this.pipeline = Boolean(config.pipeline);
      this._pipelineInFlight = false;
      const cp = this.connectionParameters = new ConnectionParameters(config);
      if (config.nativeConnectionString) cp.nativeConnectionString = config.nativeConnectionString;
      this.user = cp.user;
      Object.defineProperty(this, "password", {
        configurable: true,
        enumerable: false,
        writable: true,
        value: cp.password
      });
      this.database = cp.database;
      this.host = cp.host;
      this.port = cp.port;
      this.namedQueries = {};
    };
    Client2.Query = NativeQuery;
    util.inherits(Client2, EventEmitter);
    Client2.prototype._errorAllQueries = function(err) {
      const enqueueError = /* @__PURE__ */ __name((query) => {
        process.nextTick(() => {
          query.native = this.native;
          query.handleError(err);
        });
      }, "enqueueError");
      if (this._hasActiveQuery()) {
        enqueueError(this._activeQuery);
        this._activeQuery = null;
      }
      this._queryQueue.forEach(enqueueError);
      this._queryQueue.length = 0;
    };
    Client2.prototype._connect = function(cb) {
      const self = this;
      if (this._connecting) {
        process.nextTick(() => cb(new Error("Client has already been connected. You cannot reuse a client.")));
        return;
      }
      this._connecting = true;
      this.connectionParameters.getLibpqConnectionString(function(err, conString) {
        if (self.connectionParameters.nativeConnectionString) conString = self.connectionParameters.nativeConnectionString;
        if (err) return cb(err);
        self.native.connect(conString, function(err2) {
          if (err2) {
            self.native.end();
            return cb(err2);
          }
          self._connected = true;
          self.native.on("error", function(err3) {
            self._queryable = false;
            self._errorAllQueries(err3);
            self.emit("error", err3);
          });
          self.native.on("notification", function(msg) {
            self.emit("notification", {
              channel: msg.relname,
              payload: msg.extra
            });
          });
          self.emit("connect");
          self._pulseQueryQueue(true);
          cb(null, this);
        });
      });
    };
    Client2.prototype.connect = function(callback) {
      if (callback) {
        this._connect(callback);
        return;
      }
      return new this._Promise((resolve, reject) => {
        this._connect((error) => {
          if (error) {
            reject(error);
          } else {
            resolve(this);
          }
        });
      });
    };
    Client2.prototype.query = function(config, values, callback) {
      let query;
      let result;
      let readTimeout;
      let readTimeoutTimer;
      let queryCallback;
      if (config === null || config === void 0) {
        throw new TypeError("Client was passed a null or undefined query");
      } else if (typeof config.submit === "function") {
        readTimeout = config.query_timeout || this.connectionParameters.query_timeout;
        result = query = config;
        if (typeof values === "function") {
          config.callback = values;
        }
      } else {
        readTimeout = config.query_timeout || this.connectionParameters.query_timeout;
        query = new NativeQuery(config, values, callback);
        if (!query.callback) {
          let resolveOut, rejectOut;
          result = new this._Promise((resolve, reject) => {
            resolveOut = resolve;
            rejectOut = reject;
          }).catch((err) => {
            Error.captureStackTrace(err);
            throw err;
          });
          query.callback = (err, res) => err ? rejectOut(err) : resolveOut(res);
        }
      }
      if (readTimeout) {
        queryCallback = query.callback || (() => {
        });
        readTimeoutTimer = setTimeout(() => {
          const error = new Error("Query read timeout");
          process.nextTick(() => {
            query.handleError(error, this.connection);
          });
          queryCallback(error);
          query.callback = () => {
          };
          const index = this._queryQueue.indexOf(query);
          if (index > -1) {
            this._queryQueue.splice(index, 1);
          }
          this._pulseQueryQueue();
        }, readTimeout);
        query.callback = (err, res) => {
          clearTimeout(readTimeoutTimer);
          queryCallback(err, res);
        };
      }
      if (!this._queryable) {
        query.native = this.native;
        process.nextTick(() => {
          query.handleError(new Error("Client has encountered a connection error and is not queryable"));
        });
        return result;
      }
      if (this._ending) {
        query.native = this.native;
        process.nextTick(() => {
          query.handleError(new Error("Client was closed and is not queryable"));
        });
        return result;
      }
      if (this._queryQueue.length > 0 && !this.pipeline) {
        queryQueueLengthDeprecationNotice();
      }
      this._queryQueue.push(query);
      this._pulseQueryQueue();
      return result;
    };
    Client2.prototype.end = function(cb) {
      const self = this;
      this._ending = true;
      if (this._connecting && !this._connected) {
        this.once("connect", () => {
          this.end(() => {
          });
        });
      }
      let result;
      if (!cb) {
        result = new this._Promise(function(resolve, reject) {
          cb = /* @__PURE__ */ __name((err) => err ? reject(err) : resolve(), "cb");
        });
      }
      const doEnd = /* @__PURE__ */ __name(function() {
        self.native.end(function() {
          self._connected = false;
          self._errorAllQueries(new Error("Connection terminated"));
          process.nextTick(() => {
            self.emit("end");
            if (cb) cb();
          });
        });
      }, "doEnd");
      if (this.pipeline && (this._pipelineInFlight || this._queryQueue.length > 0)) {
        this.once("drain", doEnd);
      } else {
        doEnd();
      }
      return result;
    };
    Client2.prototype._hasActiveQuery = function() {
      return this._activeQuery && this._activeQuery.state !== "error" && this._activeQuery.state !== "end";
    };
    Client2.prototype._pulseQueryQueue = function(initialConnection) {
      if (!this._connected) {
        return;
      }
      if (this.pipeline && !initialConnection) {
        return this._pulsePipelinedQueryQueue();
      }
      if (this._hasActiveQuery()) {
        return;
      }
      const query = this._queryQueue.shift();
      if (!query) {
        if (!initialConnection) {
          this.emit("drain");
        }
        return;
      }
      this._activeQuery = query;
      query.submit(this);
      const self = this;
      query.once("_done", function() {
        self._pulseQueryQueue();
      });
    };
    Client2.prototype._pulsePipelinedQueryQueue = function() {
      if (!this._connected || this._pipelineInFlight) {
        return;
      }
      if (this._queryQueue.length === 0) {
        if (this.hasExecuted) {
          this.emit("drain");
        }
        return;
      }
      this._pipelineInFlight = true;
      const self = this;
      const queries = [];
      const nativeQueries = [];
      const utils = require_utils();
      while (this._queryQueue.length > 0) {
        const query = this._queryQueue.shift();
        this.hasExecuted = true;
        nativeQueries.push(query);
        const values = query.values ? query.values.map(utils.prepareValue) : null;
        const pipelineEntry = { text: query.text, name: query.name };
        if (values) {
          pipelineEntry.values = values;
        }
        if (query.name && this.namedQueries[query.name]) {
          pipelineEntry._alreadyPrepared = true;
        }
        queries.push(pipelineEntry);
      }
      this.native.pipeline(queries, function(err, results) {
        self._pipelineInFlight = false;
        if (err) {
          for (let i = 0; i < nativeQueries.length; i++) {
            const q = nativeQueries[i];
            q.native = self.native;
            q.handleError(err);
          }
          self._pulsePipelinedQueryQueue();
          return;
        }
        for (let i = 0; i < nativeQueries.length; i++) {
          const q = nativeQueries[i];
          const r = results[i];
          q.native = self.native;
          if (r.err) {
            q.handleError(r.err);
          } else {
            if (q.name) {
              self.namedQueries[q.name] = q.text;
            }
            q.state = "end";
            q.emit("end", r.result);
            if (q.callback) {
              q.callback(null, r.result);
            }
          }
          setImmediate(function() {
            q.emit("_done");
          });
        }
        self._pulsePipelinedQueryQueue();
      });
    };
    Client2.prototype.cancel = function(query) {
      if (this._activeQuery === query) {
        this.native.cancel(function() {
        });
      } else if (this._queryQueue.indexOf(query) !== -1) {
        this._queryQueue.splice(this._queryQueue.indexOf(query), 1);
      }
    };
    Client2.prototype.ref = function() {
    };
    Client2.prototype.unref = function() {
    };
    Client2.prototype.setTypeParser = function(oid, format, parseFn) {
      return this._types.setTypeParser(oid, format, parseFn);
    };
    Client2.prototype.getTypeParser = function(oid, format) {
      return this._types.getTypeParser(oid, format);
    };
    Client2.prototype.isConnected = function() {
      return this._connected;
    };
    Client2.prototype.getTransactionStatus = function() {
      return this.native.getTransactionStatus();
    };
  }
});

// node_modules/pg/lib/native/index.js
var require_native = __commonJS({
  "node_modules/pg/lib/native/index.js"(exports, module) {
    "use strict";
    module.exports = require_client2();
  }
});

// node_modules/pg/lib/index.js
var require_lib2 = __commonJS({
  "node_modules/pg/lib/index.js"(exports, module) {
    "use strict";
    var Client2 = require_client();
    var defaults2 = require_defaults();
    var Connection2 = require_connection();
    var Result2 = require_result();
    var utils = require_utils();
    var Pool2 = require_pg_pool();
    var TypeOverrides2 = require_type_overrides();
    var { DatabaseError: DatabaseError2 } = require_dist();
    var { escapeIdentifier: escapeIdentifier2, escapeLiteral: escapeLiteral2 } = require_utils();
    var poolFactory = /* @__PURE__ */ __name((Client3) => {
      return class BoundPool extends Pool2 {
        static {
          __name(this, "BoundPool");
        }
        constructor(options) {
          super(options, Client3);
        }
      };
    }, "poolFactory");
    var PG = /* @__PURE__ */ __name(function(clientConstructor2) {
      this.defaults = defaults2;
      this.Client = clientConstructor2;
      this.Query = this.Client.Query;
      this.Pool = poolFactory(this.Client);
      this._pools = [];
      this.Connection = Connection2;
      this.types = require_pg_types();
      this.DatabaseError = DatabaseError2;
      this.TypeOverrides = TypeOverrides2;
      this.escapeIdentifier = escapeIdentifier2;
      this.escapeLiteral = escapeLiteral2;
      this.Result = Result2;
      this.utils = utils;
    }, "PG");
    var clientConstructor = Client2;
    var forceNative = false;
    try {
      forceNative = !!process.env.NODE_PG_FORCE_NATIVE;
    } catch {
    }
    if (forceNative) {
      clientConstructor = require_native();
    }
    module.exports = new PG(clientConstructor);
    Object.defineProperty(module.exports, "native", {
      configurable: true,
      enumerable: false,
      get() {
        let native = null;
        try {
          native = new PG(require_native());
        } catch (err) {
          if (err.code !== "MODULE_NOT_FOUND") {
            throw err;
          }
        }
        Object.defineProperty(module.exports, "native", {
          value: native
        });
        return native;
      }
    });
  }
});

// node_modules/hono/dist/compose.js
var compose = /* @__PURE__ */ __name((middleware, onError, onNotFound) => {
  return (context, next) => {
    let index = -1;
    return dispatch(0);
    async function dispatch(i) {
      if (i <= index) {
        throw new Error("next() called multiple times");
      }
      index = i;
      let res;
      let isError = false;
      let handler;
      if (middleware[i]) {
        handler = middleware[i][0][0];
        context.req.routeIndex = i;
      } else {
        handler = i === middleware.length && next || void 0;
      }
      if (handler) {
        try {
          res = await handler(context, () => dispatch(i + 1));
        } catch (err) {
          if (err instanceof Error && onError) {
            context.error = err;
            res = await onError(err, context);
            isError = true;
          } else {
            throw err;
          }
        }
      } else {
        if (context.finalized === false && onNotFound) {
          res = await onNotFound(context);
        }
      }
      if (res && (context.finalized === false || isError)) {
        context.res = res;
      }
      return context;
    }
    __name(dispatch, "dispatch");
  };
}, "compose");

// node_modules/hono/dist/http-exception.js
var HTTPException = class extends Error {
  static {
    __name(this, "HTTPException");
  }
  res;
  status;
  /**
   * Creates an instance of `HTTPException`.
   * @param status - HTTP status code for the exception. Defaults to 500.
   * @param options - Additional options for the exception.
   */
  constructor(status = 500, options) {
    super(options?.message, { cause: options?.cause });
    this.res = options?.res;
    this.status = status;
  }
  /**
   * Returns the response object associated with the exception.
   * If a response object is not provided, a new response is created with the error message and status code.
   * @returns The response object.
   */
  getResponse() {
    if (this.res) {
      const newResponse = new Response(this.res.body, {
        status: this.status,
        headers: this.res.headers
      });
      return newResponse;
    }
    return new Response(this.message, {
      status: this.status
    });
  }
};

// node_modules/hono/dist/request/constants.js
var GET_MATCH_RESULT = /* @__PURE__ */ Symbol();

// node_modules/hono/dist/utils/buffer.js
var bufferToFormData = /* @__PURE__ */ __name((arrayBuffer, contentType) => {
  const response = new Response(arrayBuffer, {
    headers: {
      // Normalize the media type (case-insensitive) while keeping parameters like the boundary
      "Content-Type": contentType.replace(/^[^;]+/, (mediaType) => mediaType.toLowerCase())
    }
  });
  return response.formData();
}, "bufferToFormData");

// node_modules/hono/dist/utils/body.js
var MAX_NESTING_DEPTH = 32;
var MAX_NESTED_OBJECTS = 1e4;
var isRawRequest = /* @__PURE__ */ __name((request) => "headers" in request, "isRawRequest");
var parseBody = /* @__PURE__ */ __name(async (request, options = /* @__PURE__ */ Object.create(null)) => {
  const { all = false, dot = false } = options;
  const headers = isRawRequest(request) ? request.headers : request.raw.headers;
  const contentType = headers.get("Content-Type");
  const mediaType = contentType?.split(";")[0].trim().toLowerCase();
  if (mediaType === "multipart/form-data" || mediaType === "application/x-www-form-urlencoded") {
    return parseFormData(request, { all, dot });
  }
  return {};
}, "parseBody");
async function parseFormData(request, options) {
  if (!isRawRequest(request) && request.bodyCache.formData) {
    return convertFormDataToBodyData(
      await request.bodyCache.formData,
      options
    );
  }
  const headers = isRawRequest(request) ? request.headers : request.raw.headers;
  const arrayBuffer = await request.arrayBuffer();
  const formDataPromise = bufferToFormData(arrayBuffer, headers.get("Content-Type") || "");
  if (!isRawRequest(request)) {
    request.bodyCache.formData = formDataPromise;
  }
  const formData = await formDataPromise;
  if (formData) {
    return convertFormDataToBodyData(formData, options);
  }
  return {};
}
__name(parseFormData, "parseFormData");
function convertFormDataToBodyData(formData, options) {
  const form = /* @__PURE__ */ Object.create(null);
  const nestingState = { count: 0 };
  formData.forEach((value, key) => {
    const shouldParseAllValues = options.all || key.endsWith("[]");
    if (!shouldParseAllValues) {
      form[key] = value;
    } else {
      handleParsingAllValues(form, key, value);
    }
  });
  if (options.dot) {
    Object.entries(form).forEach(([key, value]) => {
      const shouldParseDotValues = key.includes(".");
      if (shouldParseDotValues) {
        handleParsingNestedValues(form, key, value, nestingState);
        delete form[key];
      }
    });
  }
  return form;
}
__name(convertFormDataToBodyData, "convertFormDataToBodyData");
var handleParsingAllValues = /* @__PURE__ */ __name((form, key, value) => {
  if (form[key] !== void 0) {
    if (Array.isArray(form[key])) {
      ;
      form[key].push(value);
    } else {
      form[key] = [form[key], value];
    }
  } else {
    if (!key.endsWith("[]")) {
      form[key] = value;
    } else {
      form[key] = [value];
    }
  }
}, "handleParsingAllValues");
var handleParsingNestedValues = /* @__PURE__ */ __name((form, key, value, state) => {
  if (/(?:^|\.)__proto__\./.test(key)) {
    return;
  }
  let nestedForm = form;
  const keys = key.split(".", MAX_NESTING_DEPTH + 2);
  if (keys.length > MAX_NESTING_DEPTH + 1) {
    throwNestingLimitExceeded();
  }
  keys.forEach((key2, index) => {
    if (index === keys.length - 1) {
      nestedForm[key2] = value;
    } else {
      if (!nestedForm[key2] || typeof nestedForm[key2] !== "object" || Array.isArray(nestedForm[key2]) || nestedForm[key2] instanceof File) {
        if (state.count++ >= MAX_NESTED_OBJECTS) {
          throwNestingLimitExceeded();
        }
        nestedForm[key2] = /* @__PURE__ */ Object.create(null);
      }
      nestedForm = nestedForm[key2];
    }
  });
}, "handleParsingNestedValues");
var throwNestingLimitExceeded = /* @__PURE__ */ __name(() => {
  throw new Error("Nesting limit exceeded");
}, "throwNestingLimitExceeded");

// node_modules/hono/dist/utils/url.js
var splitPath = /* @__PURE__ */ __name((path) => {
  const paths = path.split("/");
  if (paths[0] === "") {
    paths.shift();
  }
  return paths;
}, "splitPath");
var splitRoutingPath = /* @__PURE__ */ __name((routePath) => {
  const { groups, path } = extractGroupsFromPath(routePath);
  const paths = splitPath(path);
  return replaceGroupMarks(paths, groups);
}, "splitRoutingPath");
var extractGroupsFromPath = /* @__PURE__ */ __name((path) => {
  const groups = [];
  path = path.replace(/\{[^}]+\}/g, (match2, index) => {
    const mark = `@${index}`;
    groups.push([mark, match2]);
    return mark;
  });
  return { groups, path };
}, "extractGroupsFromPath");
var replaceGroupMarks = /* @__PURE__ */ __name((paths, groups) => {
  for (let i = groups.length - 1; i >= 0; i--) {
    const [mark] = groups[i];
    for (let j = paths.length - 1; j >= 0; j--) {
      if (paths[j].includes(mark)) {
        paths[j] = paths[j].replace(mark, groups[i][1]);
        break;
      }
    }
  }
  return paths;
}, "replaceGroupMarks");
var patternCache = {};
var getPattern = /* @__PURE__ */ __name((label, next) => {
  if (label === "*") {
    return "*";
  }
  const match2 = label.match(/^\:([^\{\}]+)(?:\{(.+)\})?$/);
  if (match2) {
    const cacheKey = `${label}#${next}`;
    if (!patternCache[cacheKey]) {
      if (match2[2]) {
        patternCache[cacheKey] = next && next[0] !== ":" && next[0] !== "*" ? [cacheKey, match2[1], new RegExp(`^${match2[2]}(?=/${next})`)] : [label, match2[1], new RegExp(`^${match2[2]}$`)];
      } else {
        patternCache[cacheKey] = [label, match2[1], true];
      }
    }
    return patternCache[cacheKey];
  }
  return null;
}, "getPattern");
var tryDecode = /* @__PURE__ */ __name((str, decoder) => {
  try {
    return decoder(str);
  } catch {
    return str.replace(/(?:%[0-9A-Fa-f]{2})+/g, (match2) => {
      try {
        return decoder(match2);
      } catch {
        return match2;
      }
    });
  }
}, "tryDecode");
var tryDecodeURI = /* @__PURE__ */ __name((str) => tryDecode(str, decodeURI), "tryDecodeURI");
var getPath = /* @__PURE__ */ __name((request) => {
  const url = request.url;
  const start = url.indexOf("/", url.indexOf(":") + 4);
  let i = start;
  for (; i < url.length; i++) {
    const charCode = url.charCodeAt(i);
    if (charCode === 37) {
      const queryIndex = url.indexOf("?", i);
      const hashIndex = url.indexOf("#", i);
      const end = queryIndex === -1 ? hashIndex === -1 ? void 0 : hashIndex : hashIndex === -1 ? queryIndex : Math.min(queryIndex, hashIndex);
      const path = url.slice(start, end);
      return tryDecodeURI(path.includes("%25") ? path.replace(/%25/g, "%2525") : path);
    } else if (charCode === 63 || charCode === 35) {
      break;
    }
  }
  return url.slice(start, i);
}, "getPath");
var getPathNoStrict = /* @__PURE__ */ __name((request) => {
  const result = getPath(request);
  return result.length > 1 && result.at(-1) === "/" ? result.slice(0, -1) : result;
}, "getPathNoStrict");
var mergePath = /* @__PURE__ */ __name((base, sub, ...rest) => {
  if (rest.length) {
    sub = mergePath(sub, ...rest);
  }
  return `${base?.[0] === "/" ? "" : "/"}${base}${sub === "/" ? "" : `${base?.at(-1) === "/" ? "" : "/"}${sub?.[0] === "/" ? sub.slice(1) : sub}`}`;
}, "mergePath");
var checkOptionalParameter = /* @__PURE__ */ __name((path) => {
  if (path.charCodeAt(path.length - 1) !== 63 || !path.includes(":")) {
    return null;
  }
  const segments = path.split("/");
  const results = [];
  let basePath = "";
  segments.forEach((segment) => {
    if (segment !== "" && !/\:/.test(segment)) {
      basePath += "/" + segment;
    } else if (/\:/.test(segment)) {
      if (segment.charCodeAt(segment.length - 1) === 63) {
        if (results.length === 0 && basePath === "") {
          results.push("/");
        } else {
          results.push(basePath);
        }
        const optionalSegment = segment.slice(0, -1);
        basePath += "/" + optionalSegment;
        results.push(basePath);
      } else {
        basePath += "/" + segment;
      }
    }
  });
  return results.filter((v, i, a) => a.indexOf(v) === i);
}, "checkOptionalParameter");
var tryDecodeURIComponent = /* @__PURE__ */ __name((str) => str.indexOf("%") !== -1 ? tryDecode(str, decodeURIComponent_) : str, "tryDecodeURIComponent");
var _decodeURI = /* @__PURE__ */ __name((value) => {
  if (value.indexOf("+") !== -1) {
    value = value.replace(/\+/g, " ");
  }
  return tryDecodeURIComponent(value);
}, "_decodeURI");
var _getQueryParam = /* @__PURE__ */ __name((url, key, multiple) => {
  const hashIndex = url.indexOf("#", 8);
  if (hashIndex !== -1) {
    url = url.slice(0, hashIndex);
  }
  let encoded;
  if (!multiple && key && key.indexOf("%") === -1 && key.indexOf("+") === -1) {
    let keyIndex2 = url.indexOf("?", 8);
    if (keyIndex2 === -1) {
      return void 0;
    }
    if (!url.startsWith(key, keyIndex2 + 1)) {
      keyIndex2 = url.indexOf(`&${key}`, keyIndex2 + 1);
    }
    while (keyIndex2 !== -1) {
      const trailingKeyCode = url.charCodeAt(keyIndex2 + key.length + 1);
      if (trailingKeyCode === 61) {
        const valueIndex = keyIndex2 + key.length + 2;
        const endIndex = url.indexOf("&", valueIndex);
        return _decodeURI(url.slice(valueIndex, endIndex === -1 ? void 0 : endIndex));
      } else if (trailingKeyCode == 38 || isNaN(trailingKeyCode)) {
        return "";
      }
      keyIndex2 = url.indexOf(`&${key}`, keyIndex2 + 1);
    }
    encoded = /[%+]/.test(url);
    if (!encoded) {
      return void 0;
    }
  }
  const results = /* @__PURE__ */ Object.create(null);
  encoded ??= /[%+]/.test(url);
  let keyIndex = url.indexOf("?", 8);
  while (keyIndex !== -1) {
    const nextKeyIndex = url.indexOf("&", keyIndex + 1);
    let valueIndex = url.indexOf("=", keyIndex);
    if (valueIndex > nextKeyIndex && nextKeyIndex !== -1) {
      valueIndex = -1;
    }
    let name = url.slice(
      keyIndex + 1,
      valueIndex === -1 ? nextKeyIndex === -1 ? void 0 : nextKeyIndex : valueIndex
    );
    if (encoded) {
      name = _decodeURI(name);
    }
    keyIndex = nextKeyIndex;
    if (name === "") {
      continue;
    }
    let value;
    if (valueIndex === -1) {
      value = "";
    } else {
      value = url.slice(valueIndex + 1, nextKeyIndex === -1 ? void 0 : nextKeyIndex);
      if (encoded) {
        value = _decodeURI(value);
      }
    }
    if (multiple) {
      if (!(results[name] && Array.isArray(results[name]))) {
        results[name] = [];
      }
      ;
      results[name].push(value);
    } else {
      results[name] ??= value;
    }
  }
  return key ? results[key] : results;
}, "_getQueryParam");
var getQueryParam = _getQueryParam;
var getQueryParams = /* @__PURE__ */ __name((url, key) => {
  return _getQueryParam(url, key, true);
}, "getQueryParams");
var decodeURIComponent_ = decodeURIComponent;

// node_modules/hono/dist/request.js
var HonoRequest = class {
  static {
    __name(this, "HonoRequest");
  }
  /**
   * `.raw` can get the raw Request object.
   *
   * @see {@link https://hono.dev/docs/api/request#raw}
   *
   * @example
   * ```ts
   * // For Cloudflare Workers
   * app.post('/', async (c) => {
   *   const metadata = c.req.raw.cf?.hostMetadata?
   *   ...
   * })
   * ```
   */
  raw;
  #validatedData;
  // Short name of validatedData
  #matchResult;
  routeIndex = 0;
  /**
   * `.path` can get the pathname of the request.
   *
   * @see {@link https://hono.dev/docs/api/request#path}
   *
   * @example
   * ```ts
   * app.get('/about/me', (c) => {
   *   const pathname = c.req.path // `/about/me`
   * })
   * ```
   */
  path;
  bodyCache = {};
  constructor(request, path = "/", matchResult = [[]]) {
    this.raw = request;
    this.path = path;
    this.#matchResult = matchResult;
  }
  param(key) {
    return key ? this.#getDecodedParam(key) : this.#getAllDecodedParams();
  }
  #getDecodedParam(key) {
    const paramKey = this.#matchResult[0][this.routeIndex]?.[1][key];
    const param = this.#getParamValue(paramKey);
    return param && tryDecodeURIComponent(param);
  }
  #getAllDecodedParams() {
    const decoded = {};
    const keys = Object.keys(this.#matchResult[0][this.routeIndex]?.[1] ?? {});
    for (const key of keys) {
      const value = this.#getParamValue(this.#matchResult[0][this.routeIndex][1][key]);
      if (value !== void 0) {
        decoded[key] = tryDecodeURIComponent(value);
      }
    }
    return decoded;
  }
  #getParamValue(paramKey) {
    return this.#matchResult[1] ? this.#matchResult[1][paramKey] : paramKey;
  }
  query(key) {
    return getQueryParam(this.url, key);
  }
  queries(key) {
    return getQueryParams(this.url, key);
  }
  header(name) {
    if (name) {
      return this.raw.headers.get(name) ?? void 0;
    }
    const headerData = /* @__PURE__ */ Object.create(null);
    this.raw.headers.forEach((value, key) => {
      headerData[key] = value;
    });
    return headerData;
  }
  async parseBody(options) {
    return parseBody(this, options);
  }
  #cachedBody = /* @__PURE__ */ __name((key) => {
    const { bodyCache, raw: raw2 } = this;
    const cachedBody = bodyCache[key];
    if (cachedBody) {
      return cachedBody;
    }
    for (const anyCachedKey in bodyCache) {
      return bodyCache[anyCachedKey].then((body2) => {
        if (anyCachedKey === "json") {
          body2 = JSON.stringify(body2);
        }
        const contentType = anyCachedKey === "formData" ? void 0 : raw2.headers.get("content-type");
        return new Response(body2, {
          headers: contentType ? { "Content-Type": contentType } : void 0
        })[key]();
      });
    }
    return bodyCache[key] = raw2[key]();
  }, "#cachedBody");
  /**
   * `.json()` can parse Request body of type `application/json`
   *
   * @see {@link https://hono.dev/docs/api/request#json}
   *
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.json()
   * })
   * ```
   */
  json() {
    return this.#cachedBody("text").then((text2) => JSON.parse(text2));
  }
  /**
   * `.text()` can parse Request body of type `text/plain`
   *
   * @see {@link https://hono.dev/docs/api/request#text}
   *
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.text()
   * })
   * ```
   */
  text() {
    return this.#cachedBody("text");
  }
  /**
   * `.arrayBuffer()` parse Request body as an `ArrayBuffer`
   *
   * @see {@link https://hono.dev/docs/api/request#arraybuffer}
   *
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.arrayBuffer()
   * })
   * ```
   */
  arrayBuffer() {
    return this.#cachedBody("arrayBuffer");
  }
  /**
   * `.bytes()` parses the request body as a `Uint8Array`.
   *
   * @see {@link https://hono.dev/docs/api/request#bytes}
   *
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.bytes()
   * })
   * ```
   */
  bytes() {
    return this.#cachedBody("arrayBuffer").then((buffer) => new Uint8Array(buffer));
  }
  /**
   * Parses the request body as a `Blob`.
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.blob();
   * });
   * ```
   * @see https://hono.dev/docs/api/request#blob
   */
  blob() {
    return this.#cachedBody("blob");
  }
  /**
   * Parses the request body as `FormData`.
   * @example
   * ```ts
   * app.post('/entry', async (c) => {
   *   const body = await c.req.formData();
   * });
   * ```
   * @see https://hono.dev/docs/api/request#formdata
   */
  formData() {
    return this.#cachedBody("formData");
  }
  /**
   * Adds validated data to the request.
   *
   * @param target - The target of the validation.
   * @param data - The validated data to add.
   */
  addValidatedData(target2, data) {
    ;
    (this.#validatedData ??= {})[target2] = data;
  }
  valid(target2) {
    return this.#validatedData?.[target2];
  }
  /**
   * `.url()` can get the request url strings.
   *
   * @see {@link https://hono.dev/docs/api/request#url}
   *
   * @example
   * ```ts
   * app.get('/about/me', (c) => {
   *   const url = c.req.url // `http://localhost:8787/about/me`
   *   ...
   * })
   * ```
   */
  get url() {
    return this.raw.url;
  }
  /**
   * `.method()` can get the method name of the request.
   *
   * @see {@link https://hono.dev/docs/api/request#method}
   *
   * @example
   * ```ts
   * app.get('/about/me', (c) => {
   *   const method = c.req.method // `GET`
   * })
   * ```
   */
  get method() {
    return this.raw.method;
  }
  get [GET_MATCH_RESULT]() {
    return this.#matchResult;
  }
  /**
   * `.matchedRoutes()` can return a matched route in the handler
   *
   * @deprecated
   *
   * Use matchedRoutes helper defined in "hono/route" instead.
   *
   * @see {@link https://hono.dev/docs/api/request#matchedroutes}
   *
   * @example
   * ```ts
   * app.use('*', async function logger(c, next) {
   *   await next()
   *   c.req.matchedRoutes.forEach(({ handler, method, path }, i) => {
   *     const name = handler.name || (handler.length < 2 ? '[handler]' : '[middleware]')
   *     console.log(
   *       method,
   *       ' ',
   *       path,
   *       ' '.repeat(Math.max(10 - path.length, 0)),
   *       name,
   *       i === c.req.routeIndex ? '<- respond from here' : ''
   *     )
   *   })
   * })
   * ```
   */
  get matchedRoutes() {
    return this.#matchResult[0].map(([[, route]]) => route);
  }
  /**
   * `routePath()` can retrieve the path registered within the handler
   *
   * @deprecated
   *
   * Use routePath helper defined in "hono/route" instead.
   *
   * @see {@link https://hono.dev/docs/api/request#routepath}
   *
   * @example
   * ```ts
   * app.get('/posts/:id', (c) => {
   *   return c.json({ path: c.req.routePath })
   * })
   * ```
   */
  get routePath() {
    return this.#matchResult[0].map(([[, route]]) => route)[this.routeIndex].path;
  }
};

// node_modules/hono/dist/utils/html.js
var HtmlEscapedCallbackPhase = {
  Stringify: 1,
  BeforeStream: 2,
  Stream: 3
};
var raw = /* @__PURE__ */ __name((value, callbacks) => {
  const escapedString = new String(value);
  escapedString.isEscaped = true;
  escapedString.callbacks = callbacks;
  return escapedString;
}, "raw");
var resolveCallback = /* @__PURE__ */ __name(async (str, phase, preserveCallbacks, context, buffer) => {
  if (typeof str === "object" && !(str instanceof String)) {
    if (!(str instanceof Promise)) {
      str = str.toString();
    }
    if (str instanceof Promise) {
      str = await str;
    }
  }
  const callbacks = str.callbacks;
  if (!callbacks?.length) {
    return Promise.resolve(str);
  }
  if (buffer) {
    buffer[0] += str;
  } else {
    buffer = [str];
  }
  const resStr = Promise.all(callbacks.map((c) => c({ phase, buffer, context }))).then(
    (res) => Promise.all(
      res.filter(Boolean).map((str2) => resolveCallback(str2, phase, false, context, buffer))
    ).then(() => buffer[0])
  );
  if (preserveCallbacks) {
    return raw(await resStr, callbacks);
  } else {
    return resStr;
  }
}, "resolveCallback");

// node_modules/hono/dist/context.js
var TEXT_PLAIN = "text/plain; charset=UTF-8";
var setDefaultContentType = /* @__PURE__ */ __name((contentType, headers) => {
  return {
    "Content-Type": contentType,
    ...headers
  };
}, "setDefaultContentType");
var createResponseInstance = /* @__PURE__ */ __name((body2, init) => new Response(body2, init), "createResponseInstance");
var Context = class {
  static {
    __name(this, "Context");
  }
  #rawRequest;
  #req;
  /**
   * `.env` can get bindings (environment variables, secrets, KV namespaces, D1 database, R2 bucket etc.) in Cloudflare Workers.
   *
   * @see {@link https://hono.dev/docs/api/context#env}
   *
   * @example
   * ```ts
   * // Environment object for Cloudflare Workers
   * app.get('*', async c => {
   *   const counter = c.env.COUNTER
   * })
   * ```
   */
  env = {};
  #var;
  finalized = false;
  /**
   * `.error` can get the error object from the middleware if the Handler throws an error.
   *
   * @see {@link https://hono.dev/docs/api/context#error}
   *
   * @example
   * ```ts
   * app.use('*', async (c, next) => {
   *   await next()
   *   if (c.error) {
   *     // do something...
   *   }
   * })
   * ```
   */
  error;
  #status;
  #executionCtx;
  #res;
  #layout;
  #renderer;
  #notFoundHandler;
  #preparedHeaders;
  #matchResult;
  #path;
  /**
   * Creates an instance of the Context class.
   *
   * @param req - The Request object.
   * @param options - Optional configuration options for the context.
   */
  constructor(req, options) {
    this.#rawRequest = req;
    if (options) {
      this.#executionCtx = options.executionCtx;
      this.env = options.env;
      this.#notFoundHandler = options.notFoundHandler;
      this.#path = options.path;
      this.#matchResult = options.matchResult;
    }
  }
  /**
   * `.req` is the instance of {@link HonoRequest}.
   */
  get req() {
    this.#req ??= new HonoRequest(this.#rawRequest, this.#path, this.#matchResult);
    return this.#req;
  }
  /**
   * @see {@link https://hono.dev/docs/api/context#event}
   * The FetchEvent associated with the current request.
   *
   * @throws Will throw an error if the context does not have a FetchEvent.
   */
  get event() {
    if (this.#executionCtx && "respondWith" in this.#executionCtx) {
      return this.#executionCtx;
    } else {
      throw Error("This context has no FetchEvent");
    }
  }
  /**
   * @see {@link https://hono.dev/docs/api/context#executionctx}
   * The ExecutionContext associated with the current request.
   *
   * @throws Will throw an error if the context does not have an ExecutionContext.
   */
  get executionCtx() {
    if (this.#executionCtx) {
      return this.#executionCtx;
    } else {
      throw Error("This context has no ExecutionContext");
    }
  }
  /**
   * @see {@link https://hono.dev/docs/api/context#res}
   * The Response object for the current request.
   */
  get res() {
    return this.#res ||= createResponseInstance(null, {
      headers: this.#preparedHeaders ??= new Headers()
    });
  }
  /**
   * Sets the Response object for the current request.
   *
   * @param _res - The Response object to set.
   */
  set res(_res) {
    if (this.#res && _res) {
      _res = createResponseInstance(_res.body, _res);
      for (const [k, v] of this.#res.headers.entries()) {
        if (k === "content-type") {
          continue;
        }
        if (k === "set-cookie") {
          const cookies = this.#res.headers.getSetCookie();
          _res.headers.delete("set-cookie");
          for (const cookie of cookies) {
            _res.headers.append("set-cookie", cookie);
          }
        } else {
          _res.headers.set(k, v);
        }
      }
    }
    this.#res = _res;
    this.finalized = true;
  }
  /**
   * `.render()` can create a response within a layout.
   *
   * @see {@link https://hono.dev/docs/api/context#render-setrenderer}
   *
   * @example
   * ```ts
   * app.get('/', (c) => {
   *   return c.render('Hello!')
   * })
   * ```
   */
  render = /* @__PURE__ */ __name((...args) => {
    this.#renderer ??= (content) => this.html(content);
    return this.#renderer(...args);
  }, "render");
  /**
   * Sets the layout for the response.
   *
   * @param layout - The layout to set.
   * @returns The layout function.
   */
  setLayout = /* @__PURE__ */ __name((layout) => this.#layout = layout, "setLayout");
  /**
   * Gets the current layout for the response.
   *
   * @returns The current layout function.
   */
  getLayout = /* @__PURE__ */ __name(() => this.#layout, "getLayout");
  /**
   * `.setRenderer()` can set the layout in the custom middleware.
   *
   * @see {@link https://hono.dev/docs/api/context#render-setrenderer}
   *
   * @example
   * ```tsx
   * app.use('*', async (c, next) => {
   *   c.setRenderer((content) => {
   *     return c.html(
   *       <html>
   *         <body>
   *           <p>{content}</p>
   *         </body>
   *       </html>
   *     )
   *   })
   *   await next()
   * })
   * ```
   */
  setRenderer = /* @__PURE__ */ __name((renderer) => {
    this.#renderer = renderer;
  }, "setRenderer");
  /**
   * `.header()` can set headers.
   *
   * @see {@link https://hono.dev/docs/api/context#header}
   *
   * @example
   * ```ts
   * app.get('/welcome', (c) => {
   *   // Set headers
   *   c.header('X-Message', 'Hello!')
   *   c.header('Content-Type', 'text/plain')
   *
   *   // Append multiple headers using the append option (e.g. Vary)
   *   c.header('Vary', 'Accept-Encoding', { append: true })
   *   c.header('Vary', 'User-Agent', { append: true })
   *
   *   return c.body('Thank you for coming')
   * })
   * ```
   */
  header = /* @__PURE__ */ __name((name, value, options) => {
    if (this.finalized) {
      this.#res = createResponseInstance(this.#res.body, this.#res);
    }
    const headers = this.#res ? this.#res.headers : this.#preparedHeaders ??= new Headers();
    if (value === void 0) {
      headers.delete(name);
    } else if (options?.append) {
      headers.append(name, value);
    } else {
      headers.set(name, value);
    }
  }, "header");
  status = /* @__PURE__ */ __name((status) => {
    this.#status = status;
  }, "status");
  /**
   * `.set()` can set the value specified by the key.
   *
   * @see {@link https://hono.dev/docs/api/context#set-get}
   *
   * @example
   * ```ts
   * app.use('*', async (c, next) => {
   *   c.set('message', 'Hono is hot!!')
   *   await next()
   * })
   * ```
   */
  set = /* @__PURE__ */ __name((key, value) => {
    this.#var ??= /* @__PURE__ */ new Map();
    this.#var.set(key, value);
  }, "set");
  /**
   * `.get()` can use the value specified by the key.
   *
   * @see {@link https://hono.dev/docs/api/context#set-get}
   *
   * @example
   * ```ts
   * app.get('/', (c) => {
   *   const message = c.get('message')
   *   return c.text(`The message is "${message}"`)
   * })
   * ```
   */
  get = /* @__PURE__ */ __name((key) => {
    return this.#var ? this.#var.get(key) : void 0;
  }, "get");
  /**
   * `.var` can access the value of a variable.
   *
   * @see {@link https://hono.dev/docs/api/context#var}
   *
   * @example
   * ```ts
   * const result = c.var.client.oneMethod()
   * ```
   */
  // c.var.propName is a read-only
  get var() {
    if (!this.#var) {
      return {};
    }
    return Object.fromEntries(this.#var);
  }
  #newResponse(data, arg, headers) {
    let responseHeaders = this.#res ? new Headers(this.#res.headers) : this.#preparedHeaders;
    if (typeof arg === "object" && arg.headers) {
      responseHeaders ??= new Headers();
      for (const [key, value] of new Headers(arg.headers)) {
        if (key === "set-cookie") {
          responseHeaders.append(key, value);
        } else {
          responseHeaders.set(key, value);
        }
      }
    }
    if (headers) {
      if (!responseHeaders) {
        let count = 0;
        for (const k in headers) {
          if (++count > 1 || typeof headers[k] !== "string") {
            responseHeaders = new Headers();
            break;
          }
        }
      }
      if (responseHeaders) {
        for (const k in headers) {
          const v = headers[k];
          if (typeof v === "string") {
            responseHeaders.set(k, v);
          } else {
            responseHeaders.delete(k);
            for (const v2 of v) {
              responseHeaders.append(k, v2);
            }
          }
        }
      }
    }
    const status = typeof arg === "number" ? arg : arg?.status ?? this.#status;
    return createResponseInstance(data, {
      status,
      headers: responseHeaders ?? headers
    });
  }
  newResponse = /* @__PURE__ */ __name((...args) => this.#newResponse(...args), "newResponse");
  /**
   * `.body()` can return the HTTP response.
   * You can set headers with `.header()` and set HTTP status code with `.status`.
   * This can also be set in `.text()`, `.json()` and so on.
   *
   * @see {@link https://hono.dev/docs/api/context#body}
   *
   * @example
   * ```ts
   * app.get('/welcome', (c) => {
   *   // Set headers
   *   c.header('X-Message', 'Hello!')
   *   c.header('Content-Type', 'text/plain')
   *   // Set HTTP status code
   *   c.status(201)
   *
   *   // Return the response body
   *   return c.body('Thank you for coming')
   * })
   * ```
   */
  body = /* @__PURE__ */ __name((data, arg, headers) => this.#newResponse(data, arg, headers), "body");
  /**
   * `.text()` can render text as `Content-Type:text/plain`.
   *
   * @see {@link https://hono.dev/docs/api/context#text}
   *
   * @example
   * ```ts
   * app.get('/say', (c) => {
   *   return c.text('Hello!')
   * })
   * ```
   */
  text = /* @__PURE__ */ __name((text2, arg, headers) => {
    return !this.#preparedHeaders && !this.#status && !arg && !headers && !this.finalized ? new Response(text2) : this.#newResponse(
      text2,
      arg,
      setDefaultContentType(TEXT_PLAIN, headers)
    );
  }, "text");
  /**
   * `.json()` can render JSON as `Content-Type:application/json`.
   *
   * @see {@link https://hono.dev/docs/api/context#json}
   *
   * @example
   * ```ts
   * app.get('/api', (c) => {
   *   return c.json({ message: 'Hello!' })
   * })
   * ```
   */
  json = /* @__PURE__ */ __name((object, arg, headers) => {
    return this.#newResponse(
      JSON.stringify(object),
      arg,
      setDefaultContentType("application/json", headers)
    );
  }, "json");
  html = /* @__PURE__ */ __name((html2, arg, headers) => {
    const res = /* @__PURE__ */ __name((html22) => this.#newResponse(html22, arg, setDefaultContentType("text/html; charset=UTF-8", headers)), "res");
    return typeof html2 === "object" ? resolveCallback(html2, HtmlEscapedCallbackPhase.Stringify, false, {}).then(res) : res(html2);
  }, "html");
  /**
   * `.redirect()` can Redirect, default status code is 302.
   *
   * @see {@link https://hono.dev/docs/api/context#redirect}
   *
   * @example
   * ```ts
   * app.get('/redirect', (c) => {
   *   return c.redirect('/')
   * })
   * app.get('/redirect-permanently', (c) => {
   *   return c.redirect('/', 301)
   * })
   * ```
   */
  redirect = /* @__PURE__ */ __name((location, status) => {
    const locationString = String(location);
    this.header(
      "Location",
      // Multibytes should be encoded
      // eslint-disable-next-line no-control-regex
      !/[^\x00-\xFF]/.test(locationString) ? locationString : encodeURI(locationString)
    );
    return this.newResponse(null, status ?? 302);
  }, "redirect");
  /**
   * `.notFound()` can return the Not Found Response.
   *
   * @see {@link https://hono.dev/docs/api/context#notfound}
   *
   * @example
   * ```ts
   * app.get('/notfound', (c) => {
   *   return c.notFound()
   * })
   * ```
   */
  notFound = /* @__PURE__ */ __name(() => {
    this.#notFoundHandler ??= () => createResponseInstance();
    return this.#notFoundHandler(this);
  }, "notFound");
};

// node_modules/hono/dist/router.js
var METHOD_NAME_ALL = "ALL";
var METHOD_NAME_ALL_LOWERCASE = "all";
var METHODS = ["get", "post", "put", "delete", "options", "patch", "query"];
var MESSAGE_MATCHER_IS_ALREADY_BUILT = "Can not add a route since the matcher is already built.";
var UnsupportedPathError = class extends Error {
  static {
    __name(this, "UnsupportedPathError");
  }
};

// node_modules/hono/dist/utils/constants.js
var COMPOSED_HANDLER = "__COMPOSED_HANDLER";

// node_modules/hono/dist/hono-base.js
var notFoundHandler = /* @__PURE__ */ __name((c) => {
  return c.text("404 Not Found", 404);
}, "notFoundHandler");
var errorHandler = /* @__PURE__ */ __name((err, c) => {
  if ("getResponse" in err) {
    const res = err.getResponse();
    return c.newResponse(res.body, res);
  }
  console.error(err);
  return c.text("Internal Server Error", 500);
}, "errorHandler");
var Hono = class _Hono {
  static {
    __name(this, "_Hono");
  }
  get;
  post;
  put;
  delete;
  options;
  patch;
  query;
  all;
  on;
  use;
  /*
    This class is like an abstract class and does not have a router.
    To use it, inherit the class and implement router in the constructor.
  */
  router;
  getPath;
  // Cannot use `#` because it requires visibility at JavaScript runtime.
  _basePath = "/";
  #path = "/";
  routes = [];
  constructor(options = {}) {
    const allMethods = [...METHODS, METHOD_NAME_ALL_LOWERCASE];
    allMethods.forEach((method) => {
      this[method] = (args1, ...args) => {
        const methodName = method.toUpperCase();
        if (typeof args1 === "string") {
          this.#path = args1;
        } else {
          this.#addRoute(methodName, this.#path, args1);
        }
        args.forEach((handler) => {
          this.#addRoute(methodName, this.#path, handler);
        });
        return this;
      };
    });
    this.on = (method, path, ...handlers) => {
      for (const p of [path].flat()) {
        this.#path = p;
        for (const m of [method].flat()) {
          const methodName = m.toUpperCase();
          for (const handler of handlers) {
            this.#addRoute(methodName, this.#path, handler);
          }
        }
      }
      return this;
    };
    this.use = (arg1, ...handlers) => {
      if (typeof arg1 === "string") {
        this.#path = arg1;
      } else {
        this.#path = "*";
        handlers.unshift(arg1);
      }
      handlers.forEach((handler) => {
        this.#addRoute(METHOD_NAME_ALL, this.#path, handler);
      });
      return this;
    };
    const { strict, ...optionsWithoutStrict } = options;
    Object.assign(this, optionsWithoutStrict);
    this.getPath = strict ?? true ? options.getPath ?? getPath : getPathNoStrict;
  }
  #clone() {
    const clone = new _Hono({
      router: this.router,
      getPath: this.getPath
    });
    clone.errorHandler = this.errorHandler;
    clone.#notFoundHandler = this.#notFoundHandler;
    clone.routes = this.routes;
    return clone;
  }
  #notFoundHandler = notFoundHandler;
  // Cannot use `#` because it requires visibility at JavaScript runtime.
  errorHandler = errorHandler;
  /**
   * `.route()` allows grouping other Hono instance in routes.
   *
   * @see {@link https://hono.dev/docs/api/routing#grouping}
   *
   * @param {string} path - base Path
   * @param {Hono} app - other Hono instance
   * @returns {Hono} routed Hono instance
   *
   * @example
   * ```ts
   * const app = new Hono()
   * const app2 = new Hono()
   *
   * app2.get("/user", (c) => c.text("user"))
   * app.route("/api", app2) // GET /api/user
   * ```
   */
  route(path, app2) {
    const subApp = this.basePath(path);
    app2.routes.map((r) => {
      let handler;
      if (app2.errorHandler === errorHandler) {
        handler = r.handler;
      } else {
        handler = /* @__PURE__ */ __name(async (c, next) => (await compose([], app2.errorHandler)(c, () => r.handler(c, next))).res, "handler");
        handler[COMPOSED_HANDLER] = r.handler;
      }
      subApp.#addRoute(r.method, r.path, handler, r.basePath);
    });
    return this;
  }
  /**
   * `.basePath()` allows base paths to be specified.
   *
   * @see {@link https://hono.dev/docs/api/routing#base-path}
   *
   * @param {string} path - base Path
   * @returns {Hono} changed Hono instance
   *
   * @example
   * ```ts
   * const api = new Hono().basePath('/api')
   * ```
   */
  basePath(path) {
    const subApp = this.#clone();
    subApp._basePath = mergePath(this._basePath, path);
    return subApp;
  }
  /**
   * `.onError()` handles an error and returns a customized Response.
   *
   * @see {@link https://hono.dev/docs/api/hono#error-handling}
   *
   * @param {ErrorHandler} handler - request Handler for error
   * @returns {Hono} changed Hono instance
   *
   * @example
   * ```ts
   * app.onError((err, c) => {
   *   console.error(`${err}`)
   *   return c.text('Custom Error Message', 500)
   * })
   * ```
   */
  onError = /* @__PURE__ */ __name((handler) => {
    this.errorHandler = handler;
    return this;
  }, "onError");
  /**
   * `.notFound()` allows you to customize a Not Found Response.
   *
   * @see {@link https://hono.dev/docs/api/hono#not-found}
   *
   * @param {NotFoundHandler} handler - request handler for not-found
   * @returns {Hono} changed Hono instance
   *
   * @example
   * ```ts
   * app.notFound((c) => {
   *   return c.text('Custom 404 Message', 404)
   * })
   * ```
   */
  notFound = /* @__PURE__ */ __name((handler) => {
    this.#notFoundHandler = handler;
    return this;
  }, "notFound");
  /**
   * `.mount()` allows you to mount applications built with other frameworks into your Hono application.
   *
   * @see {@link https://hono.dev/docs/api/hono#mount}
   *
   * @param {string} path - base Path
   * @param {Function} applicationHandler - other Request Handler
   * @param {MountOptions} [options] - options of `.mount()`
   * @returns {Hono} mounted Hono instance
   *
   * @example
   * ```ts
   * import { Router as IttyRouter } from 'itty-router'
   * import { Hono } from 'hono'
   * // Create itty-router application
   * const ittyRouter = IttyRouter()
   * // GET /itty-router/hello
   * ittyRouter.get('/hello', () => new Response('Hello from itty-router'))
   *
   * const app = new Hono()
   * app.mount('/itty-router', ittyRouter.handle)
   * ```
   *
   * @example
   * ```ts
   * const app = new Hono()
   * // Send the request to another application without modification.
   * app.mount('/app', anotherApp, {
   *   replaceRequest: (req) => req,
   * })
   * ```
   */
  mount(path, applicationHandler, options) {
    let replaceRequest;
    let optionHandler;
    if (options) {
      if (typeof options === "function") {
        optionHandler = options;
      } else {
        optionHandler = options.optionHandler;
        if (options.replaceRequest === false) {
          replaceRequest = /* @__PURE__ */ __name((request) => request, "replaceRequest");
        } else {
          replaceRequest = options.replaceRequest;
        }
      }
    }
    const getOptions = optionHandler ? (c) => {
      const options2 = optionHandler(c);
      return Array.isArray(options2) ? options2 : [options2];
    } : (c) => {
      let executionContext = void 0;
      try {
        executionContext = c.executionCtx;
      } catch {
      }
      return [c.env, executionContext];
    };
    replaceRequest ||= (() => {
      const mergedPath = mergePath(this._basePath, path);
      const pathPrefixLength = mergedPath === "/" ? 0 : mergedPath.length;
      return (request) => {
        const url = new URL(request.url);
        url.pathname = this.getPath(request).slice(pathPrefixLength) || "/";
        return new Request(url, request);
      };
    })();
    const handler = /* @__PURE__ */ __name(async (c, next) => {
      const res = await applicationHandler(replaceRequest(c.req.raw), ...getOptions(c));
      if (res) {
        return res;
      }
      await next();
    }, "handler");
    this.#addRoute(METHOD_NAME_ALL, mergePath(path, "*"), handler);
    return this;
  }
  #addRoute(method, path, handler, baseRoutePath) {
    path = mergePath(this._basePath, path);
    const r = {
      basePath: baseRoutePath !== void 0 ? mergePath(this._basePath, baseRoutePath) : this._basePath,
      path,
      method,
      handler
    };
    this.router.add(method, path, [handler, r]);
    this.routes.push(r);
  }
  #handleError(err, c) {
    if (err instanceof Error) {
      return this.errorHandler(err, c);
    }
    throw err;
  }
  #dispatch(request, executionCtx, env, method) {
    if (method === "HEAD") {
      return (async () => new Response(null, await this.#dispatch(request, executionCtx, env, "GET")))();
    }
    const path = this.getPath(request, { env });
    const matchResult = this.router.match(method, path);
    const c = new Context(request, {
      path,
      matchResult,
      env,
      executionCtx,
      notFoundHandler: this.#notFoundHandler
    });
    if (matchResult[0].length === 1) {
      let res;
      try {
        res = matchResult[0][0][0][0](c, async () => {
          c.res = await this.#notFoundHandler(c);
        });
      } catch (err) {
        return this.#handleError(err, c);
      }
      return res instanceof Promise ? res.then(
        (resolved) => resolved || (c.finalized ? c.res : this.#notFoundHandler(c))
      ).catch((err) => this.#handleError(err, c)) : res ?? this.#notFoundHandler(c);
    }
    const composed = compose(matchResult[0], this.errorHandler, this.#notFoundHandler);
    return (async () => {
      try {
        const context = await composed(c);
        if (!context.finalized) {
          throw new Error(
            "Context is not finalized. Did you forget to return a Response object or `await next()`?"
          );
        }
        return context.res;
      } catch (err) {
        return this.#handleError(err, c);
      }
    })();
  }
  /**
   * `.fetch()` will be entry point of your app.
   *
   * @see {@link https://hono.dev/docs/api/hono#fetch}
   *
   * @param {Request} request - request Object of request
   * @param {Env} env - env Object
   * @param {ExecutionContext} executionCtx - context of execution
   * @returns {Response | Promise<Response>} response of request
   *
   */
  fetch = /* @__PURE__ */ __name((request, ...rest) => {
    return this.#dispatch(request, rest[1], rest[0], request.method);
  }, "fetch");
  /**
   * `.request()` is a useful method for testing.
   * You can pass a URL or pathname to send a GET request.
   * app will return a Response object.
   * ```ts
   * test('GET /hello is ok', async () => {
   *   const res = await app.request('/hello')
   *   expect(res.status).toBe(200)
   * })
   * ```
   * @see https://hono.dev/docs/api/hono#request
   */
  request = /* @__PURE__ */ __name((input, requestInit, Env, executionCtx) => {
    if (input instanceof Request) {
      return this.fetch(requestInit ? new Request(input, requestInit) : input, Env, executionCtx);
    }
    input = input.toString();
    return this.fetch(
      new Request(
        /^https?:\/\//.test(input) ? input : `http://localhost${mergePath("/", input)}`,
        requestInit
      ),
      Env,
      executionCtx
    );
  }, "request");
  /**
   * `.fire()` automatically adds a global fetch event listener.
   * This can be useful for environments that adhere to the Service Worker API, such as non-ES module Cloudflare Workers.
   * @deprecated
   * Use `fire` from `hono/service-worker` instead.
   * ```ts
   * import { Hono } from 'hono'
   * import { fire } from 'hono/service-worker'
   *
   * const app = new Hono()
   * // ...
   * fire(app)
   * ```
   * @see https://hono.dev/docs/api/hono#fire
   * @see https://developer.mozilla.org/en-US/docs/Web/API/Service_Worker_API
   * @see https://developers.cloudflare.com/workers/reference/migrate-to-module-workers/
   */
  fire = /* @__PURE__ */ __name(() => {
    addEventListener("fetch", (event) => {
      event.respondWith(this.#dispatch(event.request, event, void 0, event.request.method));
    });
  }, "fire");
};

// node_modules/hono/dist/router/utils.js
var createNullObject = /* @__PURE__ */ __name(() => /* @__PURE__ */ Object.create(null), "createNullObject");

// node_modules/hono/dist/router/reg-exp-router/matcher.js
var emptyParam = [];
function match(method, path) {
  const matchers = this.buildAllMatchers();
  const match2 = /* @__PURE__ */ __name(((method2, path2) => {
    const matcher = matchers[method2] || matchers[METHOD_NAME_ALL];
    const staticMatch = matcher[2][path2];
    if (staticMatch) {
      return staticMatch;
    }
    const match3 = path2.match(matcher[0]);
    if (!match3) {
      return [[], emptyParam];
    }
    const index = match3.indexOf("", 1);
    return [matcher[1][index], match3];
  }), "match2");
  this.match = match2;
  return match2(method, path);
}
__name(match, "match");

// node_modules/hono/dist/router/reg-exp-router/node.js
var LABEL_REG_EXP_STR = "[^/]+";
var ONLY_WILDCARD_REG_EXP_STR = ".*";
var TAIL_WILDCARD_REG_EXP_STR = "(?:|/.*)";
var PATH_ERROR = /* @__PURE__ */ Symbol();
var regExpMetaChars = new Set(".\\+*[^]$()");
function compareKey(a, b) {
  if (a.length === 1) {
    return b.length === 1 ? a < b ? -1 : 1 : -1;
  }
  if (b.length === 1) {
    return 1;
  }
  if (a === ONLY_WILDCARD_REG_EXP_STR || a === TAIL_WILDCARD_REG_EXP_STR) {
    return b === TAIL_WILDCARD_REG_EXP_STR ? -1 : 1;
  } else if (b === ONLY_WILDCARD_REG_EXP_STR || b === TAIL_WILDCARD_REG_EXP_STR) {
    return -1;
  }
  if (a === LABEL_REG_EXP_STR) {
    return 1;
  } else if (b === LABEL_REG_EXP_STR) {
    return -1;
  }
  return a.length === b.length ? a < b ? -1 : 1 : b.length - a.length;
}
__name(compareKey, "compareKey");
var Node = class _Node {
  static {
    __name(this, "_Node");
  }
  // handler index of a dynamic path, or -1 for a static path terminal
  #index;
  #varIndex;
  #children = createNullObject();
  insert(tokens, index, paramMap, context, isStatic) {
    let node = this;
    for (let i = 0, len = tokens.length; i < len; i++) {
      const token = tokens[i];
      const pattern = token.length === 1 ? token === "*" ? i === len - 1 ? ["", "", ONLY_WILDCARD_REG_EXP_STR] : ["", "", LABEL_REG_EXP_STR] : null : token === "/*" ? ["", "", TAIL_WILDCARD_REG_EXP_STR] : token.match(/^\:([^\{\}]+)(?:\{(.+)\})?$/);
      let nextNode;
      if (pattern) {
        const name = pattern[1];
        let regexpStr = pattern[2] || LABEL_REG_EXP_STR;
        if (name && pattern[2]) {
          if (regexpStr === ".*") {
            throw PATH_ERROR;
          }
          regexpStr = regexpStr.replace(/^\((?!\?:)(?=[^)]+\)$)/, "(?:");
          if (/\((?!\?:)/.test(regexpStr)) {
            throw PATH_ERROR;
          }
          if (regexpStr.length === 1 && regExpMetaChars.has(regexpStr)) {
            throw PATH_ERROR;
          }
        }
        nextNode = node.#children[regexpStr];
        if (!nextNode) {
          if (regexpStr !== ONLY_WILDCARD_REG_EXP_STR && regexpStr !== TAIL_WILDCARD_REG_EXP_STR) {
            for (const k in node.#children) {
              if (
                // a single-char pattern coexists with single-char literals as a literal does
                (regexpStr.length > 1 || k.length > 1) && k !== ONLY_WILDCARD_REG_EXP_STR && k !== TAIL_WILDCARD_REG_EXP_STR
              ) {
                throw PATH_ERROR;
              }
            }
          }
          nextNode = node.#children[regexpStr] = new _Node();
        }
        if (name !== "") {
          nextNode.#varIndex ??= context.varIndex++;
          paramMap.push([name, nextNode.#varIndex]);
        }
      } else {
        nextNode = node.#children[token];
        if (!nextNode) {
          for (const k in node.#children) {
            if (k.length > 1 && k !== ONLY_WILDCARD_REG_EXP_STR && k !== TAIL_WILDCARD_REG_EXP_STR) {
              throw PATH_ERROR;
            }
          }
          nextNode = node.#children[token] = new _Node();
        }
      }
      node = nextNode;
    }
    if (node.#index !== void 0) {
      throw PATH_ERROR;
    }
    node.#index = isStatic ? -1 : index;
  }
  buildRegExpStr() {
    const childKeys = Object.keys(this.#children).sort(compareKey);
    const strList = childKeys.map((k) => {
      const c = this.#children[k];
      const childStr = c.buildRegExpStr();
      return childStr === "" ? "" : (typeof c.#varIndex === "number" ? `(${k})@${c.#varIndex}` : regExpMetaChars.has(k) ? `\\${k}` : k) + childStr;
    }).filter(Boolean);
    if (typeof this.#index === "number" && this.#index !== -1) {
      strList.unshift(`#${this.#index}`);
    }
    if (strList.length === 0) {
      return "";
    }
    if (strList.length === 1) {
      return strList[0];
    }
    return "(?:" + strList.join("|") + ")";
  }
};

// node_modules/hono/dist/router/reg-exp-router/trie.js
var Trie = class {
  static {
    __name(this, "Trie");
  }
  #context = { varIndex: 0 };
  #root = new Node();
  #index = 0;
  // dynamic path -> [handler index, param assoc]; static paths are not registered
  paths = createNullObject();
  insert(path, isStatic) {
    if (isStatic) {
      this.#root.insert(path.split(""), 0, [], this.#context, true);
      return;
    }
    const paramAssoc = [];
    const groups = [];
    let markedPath = path;
    for (let i = 0; ; ) {
      let replaced = false;
      markedPath = markedPath.replace(/\{[^}]+\}/g, (m) => {
        const mark = `@\\${i}`;
        groups[i] = [mark, m];
        i++;
        replaced = true;
        return mark;
      });
      if (!replaced) {
        break;
      }
    }
    const tokens = markedPath.match(/(?::[^\/]+)|(?:\/\*$)|./g) || [];
    for (let i = groups.length - 1; i >= 0; i--) {
      const [mark] = groups[i];
      for (let j = tokens.length - 1; j >= 0; j--) {
        if (tokens[j].indexOf(mark) !== -1) {
          tokens[j] = tokens[j].replace(mark, groups[i][1]);
          break;
        }
      }
    }
    this.#root.insert(tokens, this.#index, paramAssoc, this.#context, false);
    this.paths[path] = [this.#index++, paramAssoc];
  }
  buildRegExp() {
    let regexp = this.#root.buildRegExpStr();
    if (regexp === "") {
      return [/^$/, [], []];
    }
    let captureIndex = 0;
    const indexReplacementMap = [];
    const paramReplacementMap = [];
    regexp = regexp.replace(/#(\d+)|@(\d+)|\.\*\$/g, (_, handlerIndex, paramIndex) => {
      if (handlerIndex !== void 0) {
        indexReplacementMap[++captureIndex] = Number(handlerIndex);
        return "$()";
      }
      if (paramIndex !== void 0) {
        paramReplacementMap[Number(paramIndex)] = ++captureIndex;
        return "";
      }
      return "";
    });
    return [new RegExp(`^${regexp}`), indexReplacementMap, paramReplacementMap];
  }
};

// node_modules/hono/dist/router/reg-exp-router/router.js
var wildcardRegExpCache = createNullObject();
function buildWildcardRegExp(path) {
  return wildcardRegExpCache[path] ??= new RegExp(
    `^${path.replace(
      /\/:[^/{}]+(?:\{\[\^\/]\+})?(?=[/{]|$)|\/?\*$|([.\\+*[^\]$()?{}|])/g,
      (match2, metaChar) => metaChar ? `\\${metaChar}` : match2 === "/*" ? TAIL_WILDCARD_REG_EXP_STR : match2 === "*" ? ONLY_WILDCARD_REG_EXP_STR : `/:${LABEL_REG_EXP_STR}`
    )}$`
  );
}
__name(buildWildcardRegExp, "buildWildcardRegExp");
function findMiddleware(middleware, path) {
  for (const k of Object.keys(middleware).sort((a, b) => b.length - a.length)) {
    if (buildWildcardRegExp(k).test(path)) {
      return [...middleware[k]];
    }
  }
  return void 0;
}
__name(findMiddleware, "findMiddleware");
var RegExpRouter = class {
  static {
    __name(this, "RegExpRouter");
  }
  name = "RegExpRouter";
  #middleware;
  #routes;
  #tries;
  constructor() {
    this.#middleware = { [METHOD_NAME_ALL]: createNullObject() };
    this.#routes = { [METHOD_NAME_ALL]: createNullObject() };
    this.#tries = { [METHOD_NAME_ALL]: new Trie() };
  }
  #insertPath(method, path) {
    try {
      this.#tries[method].insert(path, !/\*|\/:/.test(path));
    } catch (e) {
      throw e === PATH_ERROR ? new UnsupportedPathError(path) : e;
    }
  }
  add(method, path, handler) {
    const middleware = this.#middleware;
    const routes = this.#routes;
    if (!middleware) {
      throw new Error(MESSAGE_MATCHER_IS_ALREADY_BUILT);
    }
    if (!middleware[method]) {
      this.#tries[method] = new Trie();
      for (const handlerMap of [middleware, routes]) {
        handlerMap[method] = createNullObject();
        for (const p in handlerMap[METHOD_NAME_ALL]) {
          handlerMap[method][p] = [...handlerMap[METHOD_NAME_ALL][p]];
          this.#insertPath(method, p);
        }
      }
    }
    if (path === "/*") {
      path = "*";
    }
    const methods = method === METHOD_NAME_ALL ? Object.keys(middleware) : [method];
    if (/\*$/.test(path)) {
      const re = buildWildcardRegExp(path);
      for (const m of methods) {
        if (!middleware[m][path]) {
          this.#insertPath(m, path);
          middleware[m][path] = findMiddleware(middleware[m], path) || findMiddleware(middleware[METHOD_NAME_ALL], path) || [];
        }
      }
      for (const handlerMap of [middleware, routes]) {
        for (const m of methods) {
          for (const p in handlerMap[m]) {
            re.test(p) && handlerMap[m][p].push([handler, path]);
          }
        }
      }
      return;
    }
    const paths = checkOptionalParameter(path) || [path];
    for (const path2 of paths) {
      for (const m of methods) {
        if (!routes[m][path2]) {
          this.#insertPath(m, path2);
          routes[m][path2] = findMiddleware(middleware[m], path2) || findMiddleware(middleware[METHOD_NAME_ALL], path2) || [];
        }
        routes[m][path2].push([handler, path2]);
      }
    }
  }
  match = match;
  buildAllMatchers() {
    const matchers = createNullObject();
    for (const method of Object.keys(this.#routes)) {
      matchers[method] = this.#buildMatcher(method);
    }
    this.#middleware = this.#routes = this.#tries = void 0;
    wildcardRegExpCache = createNullObject();
    return matchers;
  }
  #buildMatcher(method) {
    const middleware = this.#middleware[method];
    const routes = this.#routes[method];
    const trie = this.#tries[method];
    const staticMap = createNullObject();
    const handlerData = [];
    const [regexp, indexReplacementMap, paramReplacementMap] = trie.buildRegExp();
    for (const r of [middleware, routes]) {
      for (const path in r) {
        const handlers = r[path];
        const pathData = trie.paths[path];
        if (!pathData) {
          staticMap[path] = [handlers.map(([h]) => [h, createNullObject()]), emptyParam];
          continue;
        }
        handlerData[pathData[0]] = handlers.map(([h, handlerPath]) => [
          h,
          trie.paths[handlerPath][1].reduceRight((map, [key], i) => {
            map[key] = paramReplacementMap[pathData[1][i][1]];
            return map;
          }, createNullObject())
        ]);
      }
    }
    return [regexp, indexReplacementMap.map((i) => handlerData[i]), staticMap];
  }
};

// node_modules/hono/dist/router/smart-router/router.js
var SmartRouter = class {
  static {
    __name(this, "SmartRouter");
  }
  name = "SmartRouter";
  #routers = [];
  #routes = [];
  constructor(init) {
    this.#routers = init.routers;
  }
  add(method, path, handler) {
    if (!this.#routes) {
      throw new Error(MESSAGE_MATCHER_IS_ALREADY_BUILT);
    }
    this.#routes.push([method, path, handler]);
  }
  match(method, path) {
    if (!this.#routes) {
      throw new Error("Fatal error");
    }
    const routers = this.#routers;
    const routes = this.#routes;
    const len = routers.length;
    let i = 0;
    let res;
    for (; i < len; i++) {
      const router = routers[i];
      try {
        for (let i2 = 0, len2 = routes.length; i2 < len2; i2++) {
          router.add(...routes[i2]);
        }
        res = router.match(method, path);
      } catch (e) {
        if (e instanceof UnsupportedPathError) {
          continue;
        }
        throw e;
      }
      this.match = router.match.bind(router);
      this.#routers = [router];
      this.#routes = void 0;
      break;
    }
    if (i === len) {
      throw new Error("Fatal error");
    }
    this.name = `SmartRouter + ${this.activeRouter.name}`;
    return res;
  }
  get activeRouter() {
    if (this.#routes || this.#routers.length !== 1) {
      throw new Error("No active router has been determined yet.");
    }
    return this.#routers[0];
  }
};

// node_modules/hono/dist/router/trie-router/node.js
var emptyParams = createNullObject();
var order = 0;
var Node2 = class _Node2 {
  static {
    __name(this, "_Node");
  }
  #methods = [];
  #children = createNullObject();
  #patterns = [];
  #pattern;
  #params = emptyParams;
  insert(method, path, handler) {
    let curNode = this;
    const parts = splitRoutingPath(path);
    const possibleKeys = /* @__PURE__ */ new Set();
    let i = 0;
    for (const p of parts) {
      const nextP = parts[++i];
      const pattern = getPattern(p, nextP) || (nextP === void 0 && p && p.indexOf("*") === p.length - 1 ? p : null);
      const isParam = Array.isArray(pattern);
      const key = isParam ? pattern[0] : pattern || p;
      const child = curNode.#children[key] ||= new _Node2();
      if (pattern && !child.#pattern) {
        child.#pattern = pattern;
        curNode.#patterns.push(child);
      }
      curNode = child;
      if (isParam) {
        possibleKeys.add(pattern[1]);
      }
    }
    curNode.#methods.push({
      [method]: {
        handler,
        possibleKeys: [...possibleKeys],
        score: ++order
      }
    });
  }
  #pushHandlerSets(handlerSets, node, method, nodeParams, params) {
    for (let i = 0, len = node.#methods.length; i < len; i++) {
      const m = node.#methods[i];
      const handlerSet = m[method] || m[METHOD_NAME_ALL];
      if (handlerSet) {
        handlerSet.params = createNullObject();
        handlerSets.push(handlerSet);
        for (let i2 = 0, len2 = handlerSet.possibleKeys.length; i2 < len2; i2++) {
          const key = handlerSet.possibleKeys[i2];
          handlerSet.params[key] = params?.[key] && !i2 ? params[key] : nodeParams[key] ?? params?.[key];
        }
      }
    }
  }
  search(method, path) {
    const handlerSets = [];
    this.#params = emptyParams;
    const curNode = this;
    let curNodes = [curNode];
    const parts = splitPath(path);
    const curNodesQueue = [];
    const len = parts.length;
    let partOffsets = null;
    for (let i = 0; i < len; i++) {
      const part = parts[i];
      const isLast = i === len - 1;
      const tempNodes = [];
      for (let j = 0, len2 = curNodes.length; j < len2; j++) {
        const node = curNodes[j];
        const nextNode = node.#children[part];
        if (nextNode) {
          nextNode.#params = node.#params;
          if (isLast) {
            if (nextNode.#children["*"]) {
              this.#pushHandlerSets(handlerSets, nextNode.#children["*"], method, node.#params);
            }
            this.#pushHandlerSets(handlerSets, nextNode, method, node.#params);
          } else {
            tempNodes.push(nextNode);
          }
        }
        for (const child of node.#patterns) {
          const pattern = child.#pattern;
          const params = node.#params === emptyParams ? {} : { ...node.#params };
          if (typeof pattern === "string") {
            if (pattern === "*" || part.startsWith(pattern.slice(0, -1))) {
              this.#pushHandlerSets(handlerSets, child, method, node.#params);
              if (pattern === "*") {
                child.#params = params;
                tempNodes.push(child);
              }
            }
            continue;
          }
          const [, name, matcher] = pattern;
          if (!part && matcher === true) {
            continue;
          }
          if (matcher !== true) {
            if (!partOffsets) {
              partOffsets = [];
              let offset = path[0] === "/" ? 1 : 0;
              for (let p = 0; p < len; p++) {
                partOffsets[p] = offset;
                offset += parts[p].length + 1;
              }
            }
            const restPathString = path.slice(partOffsets[i]);
            const m = matcher.exec(restPathString);
            if (m) {
              params[name] = m[0];
              this.#pushHandlerSets(handlerSets, child, method, node.#params, params);
              if (m[0].length === restPathString.length && child.#children["*"]) {
                this.#pushHandlerSets(
                  handlerSets,
                  child.#children["*"],
                  method,
                  node.#params,
                  params
                );
              }
              for (const _ in child.#children) {
                child.#params = params;
                const componentCount = m[0].match(/\//g)?.length ?? 0;
                const targetCurNodes = curNodesQueue[componentCount] ||= [];
                targetCurNodes.push(child);
                break;
              }
              continue;
            }
          }
          if (matcher === true || matcher.test(part)) {
            params[name] = part;
            if (isLast) {
              this.#pushHandlerSets(handlerSets, child, method, params, node.#params);
              if (child.#children["*"]) {
                this.#pushHandlerSets(
                  handlerSets,
                  child.#children["*"],
                  method,
                  params,
                  node.#params
                );
              }
            } else {
              child.#params = params;
              tempNodes.push(child);
            }
          }
        }
      }
      const shifted = curNodesQueue.shift();
      curNodes = shifted ? tempNodes.concat(shifted) : tempNodes;
    }
    if (handlerSets[1]) {
      handlerSets.sort((a, b) => {
        return a.score - b.score;
      });
    }
    return [handlerSets.map(({ handler, params }) => [handler, params])];
  }
};

// node_modules/hono/dist/router/trie-router/router.js
var TrieRouter = class {
  static {
    __name(this, "TrieRouter");
  }
  name = "TrieRouter";
  #node = new Node2();
  add(method, path, handler) {
    for (const result of checkOptionalParameter(path) || [path]) {
      this.#node.insert(method, result, handler);
    }
  }
  match(method, path) {
    return this.#node.search(method, path);
  }
};

// node_modules/hono/dist/hono.js
var Hono2 = class extends Hono {
  static {
    __name(this, "Hono");
  }
  /**
   * Creates an instance of the Hono class.
   *
   * @param options - Optional configuration options for the Hono instance.
   */
  constructor(options = {}) {
    super(options);
    this.router = options.router ?? new SmartRouter({
      routers: [new RegExpRouter(), new TrieRouter()]
    });
  }
};

// node_modules/hono/dist/middleware/body-limit/index.js
var ERROR_MESSAGE = "Payload Too Large";
var bodyLimit = /* @__PURE__ */ __name((options) => {
  const onError = options.onError || (() => {
    const res = new Response(ERROR_MESSAGE, {
      status: 413
    });
    throw new HTTPException(413, { res });
  });
  const maxSize = options.maxSize;
  return /* @__PURE__ */ __name(async function bodyLimit2(c, next) {
    if (!c.req.raw.body) {
      return next();
    }
    const hasTransferEncoding = c.req.raw.headers.has("transfer-encoding");
    const hasContentLength = c.req.raw.headers.has("content-length");
    if (hasContentLength && !hasTransferEncoding) {
      const contentLength = parseInt(c.req.raw.headers.get("content-length") || "0", 10);
      return contentLength > maxSize ? onError(c) : next();
    }
    let size = 0;
    const chunks = [];
    const rawReader = c.req.raw.body.getReader();
    for (; ; ) {
      const { done: done2, value } = await rawReader.read();
      if (done2) {
        break;
      }
      size += value.length;
      if (size > maxSize) {
        return onError(c);
      }
      chunks.push(value);
    }
    const requestInit = {
      body: new ReadableStream({
        start(controller) {
          for (const chunk of chunks) {
            controller.enqueue(chunk);
          }
          controller.close();
        }
      }),
      duplex: "half"
    };
    c.req.raw = new Request(c.req.raw, requestInit);
    return next();
  }, "bodyLimit2");
}, "bodyLimit");

// node_modules/pg/esm/index.mjs
var import_lib = __toESM(require_lib2(), 1);
var Client = import_lib.default.Client;
var Pool = import_lib.default.Pool;
var Connection = import_lib.default.Connection;
var types = import_lib.default.types;
var Query = import_lib.default.Query;
var DatabaseError = import_lib.default.DatabaseError;
var escapeIdentifier = import_lib.default.escapeIdentifier;
var escapeLiteral = import_lib.default.escapeLiteral;
var Result = import_lib.default.Result;
var TypeOverrides = import_lib.default.TypeOverrides;
var defaults = import_lib.default.defaults;

// worker/db.ts
types.setTypeParser(20, Number);
var DB = class {
  static {
    __name(this, "DB");
  }
  client;
  constructor(url) {
    this.client = new Client({ connectionString: url, connectionTimeoutMillis: 8e3, query_timeout: 15e3, statement_timeout: 15e3 });
  }
  async query(sql, params = []) {
    return (await this.client.query(sql, params)).rows;
  }
  async one(sql, params = []) {
    return (await this.query(sql, params))[0];
  }
  async transaction(action) {
    await this.query("BEGIN");
    try {
      const result = await action();
      await this.query("COMMIT");
      return result;
    } catch (error) {
      await this.query("ROLLBACK");
      throw error;
    }
  }
};

// node_modules/hono/dist/utils/cookie.js
var validCookieNameRegEx = /^[\w!#$%&'*.^`|~+-]+$/;
var relaxedCookieNameRegEx = /^[!#-:<>-[\]-~]+$/;
var validCookieValueRegEx = /^[ !#-:<-[\]-~]*$/;
var trimCookieWhitespace = /* @__PURE__ */ __name((value) => {
  let start = 0;
  let end = value.length;
  while (start < end) {
    const charCode = value.charCodeAt(start);
    if (charCode !== 32 && charCode !== 9) {
      break;
    }
    start++;
  }
  while (end > start) {
    const charCode = value.charCodeAt(end - 1);
    if (charCode !== 32 && charCode !== 9) {
      break;
    }
    end--;
  }
  return start === 0 && end === value.length ? value : value.slice(start, end);
}, "trimCookieWhitespace");
var parse = /* @__PURE__ */ __name((cookie, name) => {
  if (name && cookie.indexOf(name) === -1) {
    return {};
  }
  const pairs = cookie.split(";");
  const parsedCookie = /* @__PURE__ */ Object.create(null);
  for (const pairStr of pairs) {
    const valueStartPos = pairStr.indexOf("=");
    if (valueStartPos === -1) {
      continue;
    }
    const cookieName = trimCookieWhitespace(pairStr.substring(0, valueStartPos));
    if (name && name !== cookieName || !relaxedCookieNameRegEx.test(cookieName) || cookieName in parsedCookie) {
      continue;
    }
    let cookieValue = trimCookieWhitespace(pairStr.substring(valueStartPos + 1));
    if (cookieValue.startsWith('"') && cookieValue.endsWith('"')) {
      cookieValue = cookieValue.slice(1, -1);
    }
    if (validCookieValueRegEx.test(cookieValue)) {
      parsedCookie[cookieName] = tryDecodeURIComponent(cookieValue);
      if (name) {
        break;
      }
    }
  }
  return parsedCookie;
}, "parse");
var _serialize = /* @__PURE__ */ __name((name, value, opt = {}) => {
  if (!validCookieNameRegEx.test(name)) {
    throw new Error("Invalid cookie name");
  }
  let cookie = `${name}=${value}`;
  if (name.startsWith("__Secure-") && !opt.secure) {
    throw new Error("__Secure- Cookie must have Secure attributes");
  }
  if (name.startsWith("__Host-")) {
    if (!opt.secure) {
      throw new Error("__Host- Cookie must have Secure attributes");
    }
    if (opt.path !== "/") {
      throw new Error('__Host- Cookie must have Path attributes with "/"');
    }
    if (opt.domain) {
      throw new Error("__Host- Cookie must not have Domain attributes");
    }
  }
  for (const key of ["domain", "path", "sameSite", "priority"]) {
    if (opt[key] && /[;\r\n]/.test(opt[key])) {
      throw new Error(`${key} must not contain ";", "\\r", or "\\n"`);
    }
  }
  if (opt && typeof opt.maxAge === "number" && opt.maxAge >= 0) {
    if (opt.maxAge > 3456e4) {
      throw new Error(
        "Cookies Max-Age SHOULD NOT be greater than 400 days (34560000 seconds) in duration."
      );
    }
    cookie += `; Max-Age=${opt.maxAge | 0}`;
  }
  if (opt.domain && opt.prefix !== "host") {
    cookie += `; Domain=${opt.domain}`;
  }
  if (opt.path) {
    cookie += `; Path=${opt.path}`;
  }
  if (opt.expires) {
    if (opt.expires.getTime() - Date.now() > 3456e7) {
      throw new Error(
        "Cookies Expires SHOULD NOT be greater than 400 days (34560000 seconds) in the future."
      );
    }
    cookie += `; Expires=${opt.expires.toUTCString()}`;
  }
  if (opt.httpOnly) {
    cookie += "; HttpOnly";
  }
  if (opt.secure) {
    cookie += "; Secure";
  }
  if (opt.sameSite) {
    cookie += `; SameSite=${opt.sameSite.charAt(0).toUpperCase() + opt.sameSite.slice(1)}`;
  }
  if (opt.priority) {
    cookie += `; Priority=${opt.priority.charAt(0).toUpperCase() + opt.priority.slice(1)}`;
  }
  if (opt.partitioned) {
    if (!opt.secure) {
      throw new Error("Partitioned Cookie must have Secure attributes");
    }
    cookie += "; Partitioned";
  }
  return cookie;
}, "_serialize");
var serialize = /* @__PURE__ */ __name((name, value, opt) => {
  value = encodeURIComponent(value);
  return _serialize(name, value, opt);
}, "serialize");

// node_modules/hono/dist/helper/cookie/index.js
var getCookie = /* @__PURE__ */ __name((c, key, prefix) => {
  const cookie = c.req.raw.headers.get("Cookie");
  if (typeof key === "string") {
    if (!cookie) {
      return void 0;
    }
    let finalKey = key;
    if (prefix === "secure") {
      finalKey = "__Secure-" + key;
    } else if (prefix === "host") {
      finalKey = "__Host-" + key;
    }
    const obj2 = parse(cookie, finalKey);
    return obj2[finalKey];
  }
  if (!cookie) {
    return {};
  }
  const obj = parse(cookie);
  return obj;
}, "getCookie");
var generateCookie = /* @__PURE__ */ __name((name, value, opt) => {
  let cookie;
  if (opt?.prefix === "secure") {
    cookie = serialize("__Secure-" + name, value, { path: "/", ...opt, secure: true });
  } else if (opt?.prefix === "host") {
    cookie = serialize("__Host-" + name, value, {
      ...opt,
      path: "/",
      secure: true,
      domain: void 0
    });
  } else {
    cookie = serialize(name, value, { path: "/", ...opt });
  }
  return cookie;
}, "generateCookie");
var setCookie = /* @__PURE__ */ __name((c, name, value, opt) => {
  const cookie = generateCookie(name, value, opt);
  c.header("Set-Cookie", cookie, { append: true });
}, "setCookie");
var deleteCookie = /* @__PURE__ */ __name((c, name, opt) => {
  const deletedCookie = getCookie(c, name, opt?.prefix);
  setCookie(c, name, "", { ...opt, maxAge: 0 });
  return deletedCookie;
}, "deleteCookie");

// worker/core.ts
var fail = /* @__PURE__ */ __name((status, message) => {
  throw new HTTPException(status, { message });
}, "fail");
var admin = /* @__PURE__ */ __name((u) => !!u && ["admin", "super_admin"].includes(u.role_slug), "admin");
var student = /* @__PURE__ */ __name((u) => !!u && Boolean(u.has_active_enrollment), "student");
var staff = /* @__PURE__ */ __name((u) => admin(u), "staff");
function user(c, role = "user") {
  const u = c.get("user");
  if (!u) return fail(401, "Entre na sua conta para continuar.");
  if (role === "admin" && !admin(u) || role === "staff" && !staff(u)) return fail(403, "Acesso n\xE3o autorizado.");
  return u;
}
__name(user, "user");
function text(data, key, max = 255, required = true) {
  const value = data[key];
  if (value === void 0 || value === null || value === "") {
    if (!required) return "";
    return fail(422, `Campo obrigat\xF3rio: ${key}.`);
  }
  if (typeof value !== "string" || value.trim().length > max || !value.trim()) return fail(422, `Campo inv\xE1lido: ${key}.`);
  return value.trim();
}
__name(text, "text");
function integer(value, fallback) {
  if ((value === null || value === void 0 || value === "") && fallback !== void 0) return fallback;
  const n = Number(value);
  if (!Number.isSafeInteger(n) || n < 1) return fail(422, "Identificador ou quantidade inv\xE1lida.");
  return n;
}
__name(integer, "integer");
function choice(value, options, fallback) {
  const v = value ?? fallback;
  if (!options.includes(v)) return fail(422, "Op\xE7\xE3o inv\xE1lida.");
  return v;
}
__name(choice, "choice");
function email(data) {
  const e = text(data, "email").toLowerCase();
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e)) return fail(422, "E-mail inv\xE1lido.");
  return e;
}
__name(email, "email");
async function body(c) {
  const raw2 = await c.req.text();
  if (raw2.length > 1e5) return fail(422, "Pedido muito grande.");
  if (c.req.header("content-type")?.includes("application/json")) {
    try {
      const d = JSON.parse(raw2);
      if (!d || Array.isArray(d) || typeof d !== "object") throw 0;
      return d;
    } catch {
      return fail(400, "JSON inv\xE1lido.");
    }
  }
  return Object.fromEntries(new URLSearchParams(raw2));
}
__name(body, "body");
var jsonRequest = /* @__PURE__ */ __name((c) => c.req.path.startsWith("/api/") || c.req.header("accept")?.includes("application/json") || c.req.header("content-type")?.includes("application/json"), "jsonRequest");
var done = /* @__PURE__ */ __name((c, data, redirect = "/portal") => jsonRequest(c) ? c.json({ success: true, ...data }) : c.redirect(redirect, 303), "done");
var randomToken = /* @__PURE__ */ __name(() => Array.from(crypto.getRandomValues(new Uint8Array(32)), (b) => b.toString(16).padStart(2, "0")).join(""), "randomToken");
async function digest(value) {
  return Array.from(new Uint8Array(await crypto.subtle.digest("SHA-256", new TextEncoder().encode(value))), (b) => b.toString(16).padStart(2, "0")).join("");
}
__name(digest, "digest");
async function authenticate(c) {
  const token = getCookie(c, "rachi_session") ?? "";
  c.set("token", token);
  c.set("user", null);
  if (!/^[a-f0-9]{64}$/.test(token)) return;
  const u = await c.get("db").one(`SELECT u.id,u.name,u.email,u.phone,u.status,u.role_id,r.slug role_slug,r.name role_name,
    cu.id customer_id,cu.company_name,e.id employee_id,e.business_unit_id employee_unit,
    COALESCE(EXISTS (SELECT 1 FROM course_enrollments ce WHERE ce.customer_id=cu.id AND ce.status='active'), false) AS has_active_enrollment
    FROM worker_sessions s JOIN users u ON u.id=s.user_id LEFT JOIN roles r ON r.id=u.role_id
    LEFT JOIN customers cu ON cu.user_id=u.id AND cu.deleted_at IS NULL LEFT JOIN employees e ON e.user_id=u.id AND e.deleted_at IS NULL
    WHERE s.token_hash=$1 AND s.expires_at>now() AND u.deleted_at IS NULL AND u.status='active'`, [await digest(token)]);
  c.set("user", u ?? null);
}
__name(authenticate, "authenticate");
async function loginSession(c, id) {
  const db = c.get("db"), previous = c.get("token");
  if (previous) await db.query("DELETE FROM worker_sessions WHERE token_hash=$1", [await digest(previous)]);
  const token = randomToken();
  await db.query("INSERT INTO worker_sessions(token_hash,user_id,expires_at) VALUES($1,$2,now()+interval '12 hours')", [await digest(token), id]);
  setCookie(c, "rachi_session", token, { httpOnly: true, secure: new URL(c.req.url).protocol === "https:", sameSite: "Lax", path: "/", maxAge: 43200 });
  return token;
}
__name(loginSession, "loginSession");
async function logout(c) {
  await c.get("db").query("DELETE FROM worker_sessions WHERE token_hash=$1", [await digest(c.get("token"))]);
  deleteCookie(c, "rachi_session", { path: "/" });
}
__name(logout, "logout");
async function limit(c, category, max = 10) {
  const key = await digest(category + ":" + (c.req.header("cf-connecting-ip") ?? "local"));
  const row = await c.get("db").one(`INSERT INTO worker_rate_limits(key,attempts,expires_at) VALUES($1,1,now()+interval '15 minutes')
    ON CONFLICT(key) DO UPDATE SET attempts=CASE WHEN worker_rate_limits.expires_at<now() THEN 1 ELSE worker_rate_limits.attempts+1 END,
    expires_at=CASE WHEN worker_rate_limits.expires_at<now() THEN now()+interval '15 minutes' ELSE worker_rate_limits.expires_at END RETURNING attempts`, [key]);
  if (row.attempts > max) return fail(429, "Muitas tentativas. Aguarde 15 minutos.");
}
__name(limit, "limit");
function publicUser(u) {
  const isAdm = admin(u);
  const hasActive = Boolean(u.has_active_enrollment);
  const canAluno = isAdm || hasActive;
  return {
    id: u.id,
    name: u.name,
    nome: u.name,
    email: u.email,
    phone: u.phone,
    role: u.role_name,
    role_slug: u.role_slug,
    tipo: isAdm ? "admin" : canAluno ? "aluno" : "cliente",
    empresa: u.company_name,
    has_matricula: hasActive,
    has_active_enrollment: hasActive,
    can_admin: isAdm,
    can_aluno: canAluno,
    can_customer: true
  };
}
__name(publicUser, "publicUser");
async function customer(c) {
  const u = user(c);
  if (u.customer_id) return u.customer_id;
  const row = await c.get("db").one(`INSERT INTO customers(user_id,type,status,created_at,updated_at) VALUES($1,'individual','active',now(),now())
    ON CONFLICT(user_id) DO UPDATE SET deleted_at=NULL RETURNING id`, [u.id]);
  u.customer_id = row.id;
  return row.id;
}
__name(customer, "customer");

// worker/auth.ts
var auth = new Hono2();
auth.get("/api/session", async (c) => c.json({ user: c.get("user") ? publicUser(c.get("user")) : null }));
auth.post("/login", async (c) => {
  await limit(c, "login");
  const d = await body(c), address = email(d), password = text(d, "password", 200);
  const db = c.get("db");
  const u = await db.one(`SELECT id FROM users WHERE lower(email)=$1 AND status='active' AND deleted_at IS NULL
    AND replace(password,'$2y$','$2a$')=extensions.crypt($2,replace(password,'$2y$','$2a$'))`, [address, password]);
  if (!u) return fail(422, "E-mail ou palavra-passe incorretos.");
  await loginSession(c, u.id);
  await db.query("UPDATE users SET last_login_at=now() WHERE id=$1", [u.id]);
  const record = await db.one(`SELECT u.id,u.name,u.email,u.phone,r.slug role_slug,r.name role_name,
    cu.company_name,
    COALESCE(EXISTS (SELECT 1 FROM course_enrollments ce WHERE ce.customer_id=cu.id AND ce.status='active'), false) AS has_active_enrollment
    FROM users u LEFT JOIN roles r ON r.id=u.role_id
    LEFT JOIN customers cu ON cu.user_id=u.id AND cu.deleted_at IS NULL
    WHERE u.id=$1`, [u.id]);
  const isAdmin = ["admin", "super_admin"].includes(record?.role_slug);
  const target2 = isAdmin ? "/admin-dashboard" : "/portal";
  return done(c, { redirect: target2, user: publicUser(record) }, target2);
});
auth.post("/registro", async (c) => {
  await limit(c, "register", 5);
  const d = await body(c), address = email(d), name = text(d, "name"), password = text(d, "password", 72);
  if (password.length < 10 || new TextEncoder().encode(password).length > 72 || password !== d.password_confirmation) return fail(422, "Use uma palavra-passe de 10 a 72 bytes e confirme-a.");
  const db = c.get("db");
  const u = await db.transaction(async () => {
    if (await db.one("SELECT id FROM users WHERE lower(email)=$1", [address])) return fail(409, "E-mail j\xE1 cadastrado.");
    const role = await db.one("SELECT id FROM roles WHERE slug='customer'");
    const u2 = await db.one(`INSERT INTO users(name,email,password,phone,role_id,status,created_at,updated_at)
      VALUES($1,$2,extensions.crypt($3,extensions.gen_salt('bf',12)),$4,$5,'active',now(),now()) RETURNING id`, [name, address, password, text(d, "phone", 30, false), role?.id]);
    await db.query(`INSERT INTO customers(user_id,type,document,company_name,phone,status,created_at,updated_at) VALUES($1,$2,$3,$4,$5,'active',now(),now())`, [u2.id, choice(d.type, ["individual", "company"], "individual"), text(d, "document", 30, false), text(d, "company_name", 255, false), text(d, "phone", 30, false)]);
    return u2;
  });
  await loginSession(c, u.id);
  return done(c, { redirect: "/portal" }, "/portal");
});
auth.post("/logout", async (c) => {
  await logout(c);
  return done(c, { redirect: "/" }, "/");
});
auth.post("/api/account/password", async (c) => {
  const u = user(c), d = await body(c);
  await limit(c, "password", 5);
  const current = text(d, "current_password", 200), next = text(d, "password", 72);
  if (next.length < 10 || new TextEncoder().encode(next).length > 72 || next !== d.password_confirmation) return fail(422, "Confirme a nova palavra-passe (10 a 72 bytes).");
  const result = await c.get("db").one(`UPDATE users SET password=extensions.crypt($1,extensions.gen_salt('bf',12)),updated_at=now()
    WHERE id=$2 AND replace(password,'$2y$','$2a$')=extensions.crypt($3,replace(password,'$2y$','$2a$')) RETURNING id`, [next, u.id, current]);
  if (!result) return fail(422, "Palavra-passe atual incorreta.");
  await c.get("db").query("DELETE FROM worker_sessions WHERE user_id=$1", [u.id]);
  await loginSession(c, u.id);
  return c.json({ success: true });
});

// worker/course-show.ts
function esc(value) {
  return String(value ?? "").replace(/[&<>"']/g, (c) => ({
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;"
  })[c] || c);
}
__name(esc, "esc");
function formatKz(price) {
  const num = Number(price);
  if (isNaN(num) || num <= 0) return "Sob Consulta";
  return new Intl.NumberFormat("pt-AO", { maximumFractionDigits: 0 }).format(num);
}
__name(formatKz, "formatKz");
function renderCourseShow(course, modules = [], relatedCourses = [], matriculaSuccess = null) {
  const totalLessons = modules.reduce((acc, m) => {
    const list2 = Array.isArray(m.lessons) ? m.lessons : [];
    return acc + list2.length;
  }, 0);
  const levelMap = {
    beginner: "Iniciante",
    intermediate: "Intermedi\xE1rio",
    advanced: "Avan\xE7ado"
  };
  const levelText = levelMap[course.level] || "Do B\xE1sico ao Avan\xE7ado";
  const priceFormatted = formatKz(course.price);
  const isConsultation = priceFormatted === "Sob Consulta";
  const defaultWaText = encodeURIComponent(`Ol\xE1! Gostaria de obter informa\xE7\xF5es sobre a forma\xE7\xE3o: ${course.name}`);
  const whatsappInquiry = `https://wa.me/244923000000?text=${defaultWaText}`;
  return `<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">
<head><link rel="stylesheet" href="/toast.css"><script src="/toast.js"><\/script><script src="/auth-session.js"><\/script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>${esc(course.name)} \u2014 RACHI Academy</title>
    <meta name="description" content="${esc(course.short_description || course.description || "")}">
    <link rel="canonical" href="https://rachi.casimirogundja.workers.dev/academy/cursos/${esc(course.slug)}">

    <!-- Open Graph -->
    <meta property="og:title" content="${esc(course.name)} \u2014 RACHI Academy">
    <meta property="og:description" content="${esc(course.short_description || course.description || "")}">
    <meta property="og:url" content="https://rachi.casimirogundja.workers.dev/academy/cursos/${esc(course.slug)}">
    <meta property="og:site_name" content="RACHI Academy">
    <meta property="og:locale" content="pt_AO">
    <meta property="og:image" content="/images/areas/rachi-academy.png">
    <meta property="og:type" content="article">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    <link rel="shortcut icon" href="/images/logo-rachi-light.png">

    <!-- Fonts: Inter & Encode Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer><\/script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"><\/script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"><\/script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"><\/script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        heading: ['"Encode Sans"', '"Inter"', 'sans-serif'],
                    },
                    colors: {
                        rachi: {
                            navy: '#071326',
                            navyLight: '#0d1f3d',
                            blue: '#00a3e0',
                            blueDark: '#0050f0',
                            blueHover: '#0042c7',
                            surface: '#0c1527',
                            surfaceDark: '#070f1e',
                            border: '#162744',
                        }
                    }
                }
            }
        };
    <\/script>

    <!-- Anti-Flash Dark Mode Script -->
    <script>
        (function() {
            var theme = localStorage.getItem('rachi_theme');
            if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        window.toggleRachiTheme = function() {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('rachi_theme', isDark ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            return isDark;
        };
    <\/script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        html.dark body {
            background-color: #070f1e;
            color: #ffffff;
        }
        .font-heading {
            font-family: 'Encode Sans', sans-serif;
        }
        .glow-rachi {
            box-shadow: 0 0 35px -8px rgba(0, 163, 224, 0.35);
        }
    </style>
</head>
<body x-data="{ openMatriculaModal: false, activeModule: 1 }">

    <!-- HEADER CORPORATIVO RACHI ACADEMY -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-[#070f1e]/95 backdrop-blur-xl border-b border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(15,23,42,0.08),0_1px_4px_rgba(15,23,42,0.05)] dark:shadow-[0_4px_30px_rgba(0,0,0,0.45)] transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <!-- Logo & Voltar -->
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="/academy" class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-[#0050f0] dark:hover:text-[#00a3e0] text-sm font-semibold transition-colors group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="hidden sm:inline">Voltar para Academy</span>
                </a>
                <span class="h-5 w-px bg-slate-200 dark:bg-white/10 hidden sm:block"></span>
                <a href="/" class="flex items-center gap-2.5">
                    <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 w-auto dark:block hidden">
                    <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-8 w-auto dark:hidden block">
                    <span class="text-xs font-bold tracking-widest px-2 py-0.5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 uppercase">Academy</span>
                </a>
            </div>

            <!-- Bot\xF5es de A\xE7\xE3o Header -->
            <div class="flex items-center gap-3">
                <a href="/academy/login" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 hover:bg-[#0050f0]/20 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 transition hidden sm:inline-flex items-center gap-1.5">
                    <i data-lucide="user" class="w-3.5 h-3.5"></i>
                    <span>Portal do Aluno</span>
                </a>
                <!-- Toggle Dark Mode -->
                <button type="button" onclick="toggleRachiTheme()" aria-label="Alternar Tema" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-200 hover:text-[#0050f0] dark:hover:text-[#00a3e0] flex items-center justify-center transition-colors">
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- BREADCRUMBS -->
    <nav class="bg-slate-100/60 dark:bg-[#0c1527]/50 border-b border-slate-200/80 dark:border-white/5 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center flex-wrap gap-2 text-xs font-medium text-slate-500 dark:text-slate-400">
                <li><a href="/" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">In\xEDcio</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">RACHI Academy</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy#cursos" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">Forma\xE7\xF5es</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li class="text-slate-900 dark:text-white font-semibold truncate max-w-[280px] sm:max-w-md">${esc(course.name)}</li>
            </ol>
        </div>
    </nav>

    <!-- ALERTA DE SUCESSO DE MATR\xCDCULA -->
    ${matriculaSuccess ? `<span hidden data-rachi-flash="success">Recebemos a sua solicita\xE7\xE3o de matr\xEDcula com sucesso e retornaremos em breve.</span>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-[#0c1527] to-[#070f1e] border-2 border-[#00a3e0] text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-[#00a3e0]/20 border border-[#00a3e0]/40 text-[#00a3e0] flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-[#00a3e0]/20 text-[#00a3e0] border border-[#00a3e0]/30 mb-2">
                            Pr\xE9-Matr\xEDcula Confirmada com Sucesso!
                        </span>
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-white tracking-tight">
                            Parab\xE9ns, ${esc(matriculaSuccess.name)}!
                        </h2>
                        <p class="text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                            A sua reserva de vaga para a forma\xE7\xE3o <strong class="text-[#00a3e0]">${esc(matriculaSuccess.course)}</strong> foi registada com o c\xF3digo oficial <span class="px-2 py-0.5 rounded bg-white/10 font-mono text-white font-bold">${esc(matriculaSuccess.code)}</span>.
                        </p>
                    </div>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                    <a href="${esc(matriculaSuccess.whatsappUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-lg transition-all">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Confirmar no WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>` : ""}

    <!-- HERO DO CURSO -->
    <section class="relative pt-10 pb-16 overflow-hidden">
        <!-- Efeito ambiente de fundo -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#00a3e0]/10 dark:bg-[#00a3e0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#0050f0]/10 dark:bg-[#0050f0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Coluna Esquerda: Informa\xE7\xF5es Principais -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Badges superiores -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 backdrop-blur-md">
                            \u2605 Forma\xE7\xE3o Oficial RACHI Academy
                        </span>
                        ${course.category_name ? `
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-200/80 dark:bg-white/10 text-slate-700 dark:text-slate-300">
                            ${esc(course.category_name)}
                        </span>` : ""}
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Inscri\xE7\xF5es Abertas
                        </span>
                    </div>

                    <!-- T\xEDtulo H1 -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-slate-900 dark:text-white tracking-tight leading-tight">
                        ${esc(course.name)}
                    </h1>

                    <!-- Descri\xE7\xE3o Curta -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        ${esc(course.short_description || course.description || "")}
                    </p>

                    <!-- P\xEDlulas de M\xE9tricas e Especifica\xE7\xF5es -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="clock" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Carga Hor\xE1ria</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">${course.duration_hours || 40} horas</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Conte\xFAdo</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">${modules.length} m\xF3dulos (${totalLessons} aulas)</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="bar-chart-2" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>N\xEDvel</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white capitalize">
                                ${esc(levelText)}
                            </span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="award" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Certifica\xE7\xE3o</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">Oficial RACHI</span>
                        </div>
                    </div>

                    <!-- Vis\xE3o Geral e Objectivos da Forma\xE7\xE3o -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xs">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                <i data-lucide="target" class="w-5 h-5"></i>
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                Vis\xE3o Geral e Objectivos da Forma\xE7\xE3o
                            </h2>
                        </div>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            ${esc(course.description || course.short_description || "")}
                        </p>

                        <!-- Destaques pr\xE1ticos -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 dark:border-white/5">
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">01</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Foco no Mercado Angolano</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Metodologia e casos pr\xE1ticos adaptados \xE0 realidade de Angola.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">02</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Aprendizagem Baseada em Projetos</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Constru\xE7\xE3o de portf\xF3lio tang\xEDvel pronto para aplica\xE7\xE3o real.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Garantias & Selos -->
                    <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-slate-200 dark:border-white/10 text-xs text-slate-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Certificado com QR Code Autentic\xE1vel</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Turmas Reduzidas & Mentoria Pr\xE1tica</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="laptop" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Laborat\xF3rios & Exerc\xEDcios Aplicados</span>
                        </span>
                    </div>
                </div>

                <!-- Coluna Direita: Card Flutuante de Matr\xEDcula -->
                <div class="lg:col-span-4 sticky top-28">
                    <div class="bg-white dark:bg-[#0c1527] border-2 border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xl dark:shadow-2xl relative overflow-hidden transition-all duration-300">
                        <!-- Top Line Gradient -->
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

                        <!-- Imagem do Curso -->
                        <div class="h-44 w-full rounded-2xl overflow-hidden mb-5 relative border border-slate-200/80 dark:border-white/10 shadow-sm">
                            <img src="/images/courses/${esc(course.slug)}.jpg" onerror="this.src='/images/areas/rachi-academy.png'" alt="${esc(course.name)}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0c1527]/80 via-transparent to-transparent"></div>
                            <span class="absolute bottom-3 left-3 px-3 py-1 rounded-full text-xs font-bold bg-[#071326]/90 text-[#00a3e0] border border-[#00a3e0]/40 backdrop-blur-md">
                                \u2605 Forma\xE7\xE3o Oficial RACHI
                            </span>
                        </div>

                        <!-- Pre\xE7o / Investimento -->
                        <div class="mb-6">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">
                                Investimento na Forma\xE7\xE3o
                            </span>
                            <div class="flex items-baseline gap-2">
                                ${isConsultation ? `
                                <span class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">
                                    Sob Consulta
                                </span>` : `
                                <span class="text-3xl sm:text-4xl font-black font-heading text-slate-900 dark:text-white tracking-tight">
                                    ${priceFormatted}
                                </span>
                                <span class="text-base font-bold text-[#0050f0] dark:text-[#00a3e0]">Kz</span>`}
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                Possibilidade de pagamento parcelado ou fatura empresarial proforma.
                            </p>
                        </div>

                        <!-- A\xE7\xF5es Imediatas -->
                        <div class="space-y-3 mb-6">
                            <button @click="openMatriculaModal = true" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-base shadow-lg shadow-[#0050f0]/30 hover:shadow-xl hover:shadow-[#0050f0]/40 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                                <span>Fazer Matr\xEDcula Agora</span>
                            </button>

                            <a href="${whatsappInquiry}" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-2xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-800 dark:text-slate-200 font-bold text-sm border border-slate-200 dark:border-white/10 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="message-square" class="w-4 h-4 text-emerald-500"></i>
                                <span>Tirar D\xFAvidas no WhatsApp</span>
                            </a>
                        </div>

                        <!-- O que est\xE1 inclu\xEDdo -->
                        <div class="border-t border-slate-100 dark:border-white/10 pt-5">
                            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-3.5">
                                O que est\xE1 inclu\xEDdo:
                            </h3>
                            <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Acesso a todas as aulas te\xF3ricas e pr\xE1ticas</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Certificado com valida\xE7\xE3o digital e QR Code</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Material did\xE1tico e apostilas em formato digital</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Mentoria direta com instrutores especializados</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Acesso ao Portal do Aluno RACHI</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DETALHES DA FORMA\xC7\xC3O & EMENTA DOS M\xD3DULOS -->
    <section class="py-12 bg-slate-50 dark:bg-[#081020] border-y border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <!-- Coluna Principal (8 colunas) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Conte\xFAdo Program\xE1tico / M\xF3dulos (Accordion) -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-xs">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                        Conte\xFAdo Program\xE1tico Completo
                                    </h2>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        ${modules.length} m\xF3dulos estruturados para o seu dom\xEDnio
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de M\xF3dulos Accordion -->
                        <div class="space-y-3">
                            ${modules.length ? modules.map((module, index) => {
    const lessons = Array.isArray(module.lessons) ? module.lessons : [];
    return `
                            <div class="border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden transition-all duration-200">
                                <button type="button" @click="activeModule = activeModule === ${index + 1} ? null : ${index + 1}" class="w-full px-5 py-4 flex items-center justify-between text-left bg-slate-50/70 dark:bg-white/[0.03] hover:bg-slate-100 dark:hover:bg-white/[0.06] transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] text-xs font-bold flex items-center justify-center">
                                            ${index + 1}
                                        </span>
                                        <div>
                                            <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">
                                                ${esc(module.title)}
                                            </h3>
                                            ${module.description ? `
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                ${esc(module.description)}
                                            </p>` : ""}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                                        <span class="hidden sm:inline">${lessons.length} aulas</span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeModule === ${index + 1} }"></i>
                                    </div>
                                </button>

                                <div x-show="activeModule === ${index + 1}" class="px-5 py-4 border-t border-slate-200 dark:border-white/5 bg-white dark:bg-[#0c1527] space-y-2.5">
                                    ${lessons.length ? lessons.map((lesson) => `
                                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 dark:border-white/[0.04] last:border-0">
                                        <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                                            <i data-lucide="play-circle" class="w-3.5 h-3.5 text-[#00a3e0]"></i>
                                            <span class="font-medium">${esc(lesson.title)}</span>
                                        </div>
                                        ${lesson.duration_minutes ? `
                                        <span class="text-slate-400 text-[11px] shrink-0">${lesson.duration_minutes} min</span>` : ""}
                                    </div>
                                    `).join("") : `
                                    <p class="text-xs text-slate-500">Aulas pr\xE1ticas em desenvolvimento para este m\xF3dulo.</p>`}
                                </div>
                            </div>
                            `;
  }).join("") : `
                            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-white/5 text-center text-sm text-slate-500">
                                Os m\xF3dulos deste curso est\xE3o a ser preparados para a pr\xF3xima turma.
                            </div>`}
                        </div>
                    </div>

                </div>

                <!-- Coluna Lateral Direita (4 colunas) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Outras Forma\xE7\xF5es Recomendadas -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-xs">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <i data-lucide="compass" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Outras Forma\xE7\xF5es RACHI</span>
                        </h3>

                        <div class="space-y-3">
                            ${relatedCourses.map((rel) => `
                            <a href="/academy/cursos/${esc(rel.slug)}" class="block p-3.5 rounded-2xl border border-slate-100 dark:border-white/5 hover:border-[#00a3e0]/40 dark:hover:border-[#00a3e0]/40 bg-slate-50/50 dark:bg-white/[0.02] hover:bg-slate-100/70 dark:hover:bg-white/[0.05] transition-all group">
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors leading-snug line-clamp-2">
                                    ${esc(rel.name)}
                                </h4>
                                <div class="flex items-center justify-between mt-2 text-[11px] text-slate-500 dark:text-slate-400">
                                    <span>${rel.duration_hours || 40}h de forma\xE7\xE3o</span>
                                    <span class="font-bold text-[#00a3e0] flex items-center gap-0.5">
                                        Ver <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                    </span>
                                </div>
                            </a>
                            `).join("")}
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-white/5 text-center">
                            <a href="/academy#cursos" class="text-xs font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline flex items-center justify-center gap-1">
                                <span>Ver Cat\xE1logo Completo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- MODAL INTERATIVO DE MATR\xCDCULA -->
    <div x-show="openMatriculaModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="openMatriculaModal" @click="openMatriculaModal = false" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

        <!-- Modal Container -->
        <div x-show="openMatriculaModal" class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl overflow-hidden z-10">
            <!-- Top Line Gradient -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

            <!-- Bot\xE3o Fechar -->
            <button type="button" @click="openMatriculaModal = false" aria-label="Fechar" class="absolute top-4 right-4 w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Cabe\xE7alho Modal -->
            <div class="mb-5 pr-8">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] mb-2">
                    RACHI Academy Matr\xEDcula
                </span>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white leading-tight">
                    ${esc(course.name)}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Preencha os dados abaixo para reservar a sua vaga oficial.
                </p>
            </div>

            <!-- Formul\xE1rio de Matr\xEDcula -->
            <form action="/academy/cursos/${esc(course.slug)}/matricula" method="POST" class="space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Nome Completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="Seu nome completo" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        E-mail <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" required placeholder="seu.email@exemplo.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Telefone / WhatsApp (Angola) <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" required placeholder="+244 923 000 000" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-sm shadow-md shadow-[#0050f0]/30 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Confirmar e Fazer Matr\xEDcula</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- FOOTER INSTITUCIONAL RACHI -->
    <footer class="bg-white dark:bg-[#070f1e] border-t border-slate-200 dark:border-white/10 py-10 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-400">
            <div class="flex items-center gap-2">
                <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-6 w-auto dark:block hidden">
                <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-6 w-auto dark:hidden block">
                <span>\xA9 2026 RACHI Academy. Todos os direitos reservados.</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Academy</a>
                <a href="/contacto" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Contacto</a>
                <a href="/academy/login" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Portal do Aluno</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    <\/script>
</body>
</html>`;
}
__name(renderCourseShow, "renderCourseShow");

// worker/catalog.ts
var catalog = new Hono2();
catalog.get("/api/catalog", async (c) => {
  const db = c.get("db");
  const products = await db.query(`SELECT p.id,p.name,p.slug,p.description,p.short_description,p.price,p.stock_quantity,p.business_unit_id,p.category_id,
    (SELECT path FROM product_images WHERE product_id=p.id ORDER BY is_primary DESC,id LIMIT 1) image FROM products p WHERE p.status='active' AND p.deleted_at IS NULL ORDER BY p.featured DESC,p.id DESC`);
  const courses = await db.query("SELECT id,name,slug,description,short_description,price,duration_hours,level,thumbnail,business_unit_id FROM courses WHERE status='published' AND deleted_at IS NULL ORDER BY id DESC");
  const services = await db.query("SELECT id,name,slug,description,short_description,base_price,pricing_type,business_unit_id FROM services WHERE status='active' AND deleted_at IS NULL ORDER BY id");
  return c.json({ products, courses, services, units: await db.query("SELECT id,name,slug FROM business_units WHERE status='active' AND deleted_at IS NULL"), categories: await db.query("SELECT id,name,slug,type,business_unit_id FROM categories WHERE deleted_at IS NULL") });
});
catalog.get("/api/academy/enrollments", async (c) => {
  user(c, "admin");
  const db = c.get("db");
  try {
    const rows = await db.query(`SELECT e.id,cu.id as aluno_id,u.name as nome,LOWER(u.email) as email,'aluno' as tipo,'ativo' as status,true as has_matricula,'ativa' as matricula_status,'RAC-' || LPAD(e.id::text,5,'0') as matricula_codigo,COALESCE(c.name,'Forma\xE7\xE3o RACHI') as curso_matriculado FROM course_enrollments e JOIN customers cu ON cu.id=e.customer_id JOIN users u ON u.id=cu.user_id LEFT JOIN courses c ON c.id=e.course_id WHERE e.status='active' AND u.deleted_at IS NULL`);
    return c.json({ enrollments: rows });
  } catch (e) {
    return c.json({ enrollments: [] });
  }
});
catalog.get("/api/courses/:slug", async (c) => {
  const db = c.get("db"), course = await db.one("SELECT id,name,slug,description,price,duration_hours,level,thumbnail FROM courses WHERE slug=$1 AND status='published' AND deleted_at IS NULL", [c.req.param("slug")]);
  if (!course) return fail(404, "Curso n\xE3o encontrado.");
  const modules = await db.query(`SELECT m.id,m.title,m.sort_order,COALESCE(json_agg(json_build_object('id',l.id,'title',l.title,'duration_minutes',l.duration_minutes) ORDER BY l.sort_order) FILTER(WHERE l.id IS NOT NULL),'[]') lessons FROM course_modules m LEFT JOIN course_lessons l ON l.course_module_id=m.id AND l.status='active' WHERE m.course_id=$1 AND m.status='active' GROUP BY m.id ORDER BY m.sort_order`, [course.id]);
  return c.json({ course, modules });
});
catalog.get("/academy/cursos/:slug", async (c) => {
  const db = c.get("db"), slug = c.req.param("slug");
  const course = await db.one("SELECT c.id,c.name,c.slug,c.description,c.short_description,c.price,c.duration_hours,c.level,c.thumbnail,cat.name category_name FROM courses c LEFT JOIN categories cat ON cat.id=c.category_id WHERE c.slug=$1 AND c.status='published' AND c.deleted_at IS NULL", [slug]);
  if (!course) return c.redirect("/academy");
  const modules = await db.query(`SELECT m.id,m.title,m.description,m.sort_order,COALESCE(json_agg(json_build_object('id',l.id,'title',l.title,'duration_minutes',l.duration_minutes) ORDER BY l.sort_order) FILTER(WHERE l.id IS NOT NULL),'[]') lessons FROM course_modules m LEFT JOIN course_lessons l ON l.course_module_id=m.id AND l.status='active' WHERE m.course_id=$1 AND m.status='active' GROUP BY m.id,m.title,m.description,m.sort_order ORDER BY m.sort_order`, [course.id]);
  const related = await db.query("SELECT id,name,slug,duration_hours FROM courses WHERE id!=$1 AND status='published' AND deleted_at IS NULL ORDER BY id DESC LIMIT 4", [course.id]);
  const matSuccess = c.req.query("matricula_sucesso") ? { name: c.req.query("nome") || "Aluno", course: course.name, code: c.req.query("codigo") || "RAC-00001", whatsappUrl: c.req.query("wa") || `https://wa.me/244923000000?text=${encodeURIComponent("Ol\xE1! Gostaria de confirmar minha matr\xEDcula.")}` } : null;
  return c.html(renderCourseShow(course, modules, related, matSuccess));
});
catalog.post("/academy/cursos/:slug/matricula", async (c) => {
  const db = c.get("db"), u = c.get("user"), d = await body(c);
  const course = await db.one("SELECT id,name,slug FROM courses WHERE slug=$1 AND status='published' AND deleted_at IS NULL", [c.req.param("slug")]);
  if (!course) return fail(404, "Curso n\xE3o encontrado.");
  let cid, studentName = u?.name || d.name || "Aluno", studentEmail = u?.email || d.email;
  if (u) {
    cid = await customer(c);
  } else if (d.email && d.name) {
    studentEmail = email(d);
    studentName = text(d, "name");
    const phone = text(d, "phone", 30, false) || null;
    cid = await db.transaction(async () => {
      let existingUser = await db.one("SELECT id,name FROM users WHERE email=$1", [studentEmail]);
      if (!existingUser) {
        existingUser = await db.one("INSERT INTO users(name,email,password,role_id,status,created_at,updated_at) VALUES($1,$2,'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',2,'active',now(),now()) RETURNING id,name", [studentName, studentEmail]);
      }
      const uid = existingUser?.id;
      let existingCustomer = await db.one("SELECT id FROM customers WHERE user_id=$1", [uid]);
      if (!existingCustomer) {
        existingCustomer = await db.one("INSERT INTO customers(user_id,type,phone,whatsapp,status,created_at,updated_at) VALUES($1,'individual',$2,$2,'active',now(),now()) RETURNING id", [uid, phone]);
      }
      return Number(existingCustomer?.id);
    });
  } else {
    return fail(401, "Identifica\xE7\xE3o necess\xE1ria para matr\xEDcula.");
  }
  const row = await db.transaction(async () => {
    await db.query("SELECT id FROM customers WHERE id=$1 FOR UPDATE", [cid]);
    const existing = await db.one("SELECT id,status FROM course_enrollments WHERE course_id=$1 AND customer_id=$2 ORDER BY id LIMIT 1", [course.id, cid]);
    if (existing && ["active", "pending", "completed"].includes(existing.status)) return existing;
    if (existing) return db.one("UPDATE course_enrollments SET status='pending',enrolled_at=now(),updated_at=now() WHERE id=$1 RETURNING id,status", [existing.id]);
    return db.one("INSERT INTO course_enrollments(course_id,customer_id,status,enrolled_at,created_at,updated_at) VALUES($1,$2,'pending',now(),now(),now()) RETURNING id,status", [course.id, cid]);
  });
  const matriculaCode = "RAC-" + String(row?.id ?? "0").padStart(5, "0");
  const waMsg = encodeURIComponent(`Ol\xE1! Fiz minha solicita\xE7\xE3o de matr\xEDcula na RACHI Academy para a forma\xE7\xE3o: ${course.name}.
Nome: ${studentName}
C\xF3digo: ${matriculaCode}
Gostaria de confirmar a vaga.`);
  const waUrl = `https://wa.me/244923000000?text=${waMsg}`;
  const contentType = c.req.header("content-type") || "";
  if (contentType.includes("form") && !c.req.header("accept")?.includes("application/json")) {
    return c.redirect(`/academy/cursos/${course.slug}?matricula_sucesso=1&nome=${encodeURIComponent(studentName)}&codigo=${matriculaCode}&wa=${encodeURIComponent(waUrl)}`);
  }
  return done(c, { enrollment: row, code: matriculaCode, whatsappUrl: waUrl, message: "Solicita\xE7\xE3o de matr\xEDcula registada." });
});
catalog.get("/api/my/courses", async (c) => {
  const u = user(c);
  return c.json({ courses: await c.get("db").query(`SELECT e.id enrollment_id,e.status enrollment_status,c.id,c.slug,c.name,c.description,c.thumbnail,c.duration_hours,
    (SELECT count(*) FROM course_progress p WHERE p.enrollment_id=e.id AND p.completed) completed_lessons FROM course_enrollments e JOIN customers cu ON cu.id=e.customer_id JOIN courses c ON c.id=e.course_id WHERE cu.user_id=$1 AND cu.deleted_at IS NULL AND c.deleted_at IS NULL ORDER BY e.id DESC`, [u.id]) });
});
catalog.get("/api/lessons/:id", async (c) => {
  const u = user(c);
  const lesson = await c.get("db").one(`SELECT l.id,l.title,l.content,l.video_url,l.duration_minutes FROM course_lessons l JOIN course_modules m ON m.id=l.course_module_id
    JOIN course_enrollments e ON e.course_id=m.course_id JOIN customers cu ON cu.id=e.customer_id WHERE l.id=$1 AND cu.user_id=$2 AND cu.deleted_at IS NULL AND e.status IN ('active','completed') AND l.status='active' AND m.status='active'`, [integer(c.req.param("id")), u.id]);
  if (!lesson) return fail(403, "Matr\xEDcula ativa necess\xE1ria.");
  return c.json({ lesson });
});
catalog.post("/api/lessons/:id/progress", async (c) => {
  const u = user(c), d = await body(c), id = integer(c.req.param("id")), db = c.get("db");
  const enrollment = await db.one(`SELECT e.id FROM course_lessons l JOIN course_modules m ON m.id=l.course_module_id JOIN course_enrollments e ON e.course_id=m.course_id JOIN customers cu ON cu.id=e.customer_id WHERE l.id=$1 AND cu.user_id=$2 AND cu.deleted_at IS NULL AND e.status='active' AND l.status='active' AND m.status='active'`, [id, u.id]);
  if (!enrollment) return fail(403, "Matr\xEDcula ativa necess\xE1ria.");
  const position = Number(d.last_position ?? 0);
  if (!Number.isSafeInteger(position) || position < 0 || position > 86400) return fail(422, "Posi\xE7\xE3o inv\xE1lida.");
  await db.query(`INSERT INTO course_progress(enrollment_id,lesson_id,completed,completed_at,last_position,created_at,updated_at)
    VALUES($1,$2,$3,CASE WHEN $3 THEN now() END,$4,now(),now()) ON CONFLICT(enrollment_id,lesson_id) DO UPDATE SET completed=course_progress.completed OR EXCLUDED.completed,completed_at=COALESCE(course_progress.completed_at,EXCLUDED.completed_at),last_position=EXCLUDED.last_position,updated_at=now()`, [enrollment.id, id, d.completed === true, position]);
  return c.json({ success: true });
});
catalog.post("/contacto", async (c) => {
  await limit(c, "contact", 5);
  const d = await body(c);
  await c.get("db").query("INSERT INTO worker_contacts(name,email,phone,subject,message) VALUES($1,$2,$3,$4,$5)", [text(d, "name"), email(d), text(d, "phone", 30, false), text(d, "subject"), text(d, "message", 3e3)]);
  return done(c, { message: "Mensagem recebida. A nossa equipa responder\xE1 em breve." }, "/contacto?enviado=1");
});

// worker/requests.ts
var requests = new Hono2();
var labels = { new: "Novo", in_analysis: "Em An\xE1lise", waiting_customer: "Ag. Cliente", quoted: "Or\xE7amento", approved: "Aprovado", in_progress: "Em Execu\xE7\xE3o", in_review: "Em Revis\xE3o", completed: "Conclu\xEDdo", cancelled: "Cancelado" };
async function accessible(c, id, lock = false) {
  const u = c.get("user"), db = c.get("db");
  const r = await db.one(`SELECT s.*,cu.user_id owner FROM service_requests s JOIN customers cu ON cu.id=s.customer_id WHERE (s.id::text=$1 OR s.protocol=$1) AND s.deleted_at IS NULL ${lock ? "FOR UPDATE OF s" : ""}`, [id]);
  if (!r) return fail(404, "Solicita\xE7\xE3o n\xE3o encontrada.");
  if (u && !admin(u) && !(staff(u) && (r.assigned_to === u.employee_id || r.business_unit_id === u.employee_unit)) && r.owner !== u.id) return fail(403, "Acesso n\xE3o autorizado.");
  return r;
}
__name(accessible, "accessible");
async function list(c) {
  const u = c.get("user"), db = c.get("db");
  const isAdmin = !u || admin(u);
  const isStaff = !u || staff(u);
  const uid = u ? u.id : 0;
  const eid = u ? u.employee_id : null;
  const eunit = u ? u.employee_unit : null;
  const rows = await db.query(`SELECT s.*,cu.company_name,cu.trade_name,cuu.name customer_name,b.name unit,eu.name responsible,
    COALESCE((SELECT json_agg(json_build_object('id',m.id,'user_id',m.user_id,'message',m.message,'text',m.message,'nome',mu.name,'sender',mu.name,'data',to_char(m.created_at,'DD/MM/YYYY HH24:MI'),'is_staff',COALESCE(mr.slug IN ('admin','super_admin','manager','employee','attendant'),false),'fromUser',NOT COALESCE(mr.slug IN ('admin','super_admin','manager','employee','attendant'),false)) ORDER BY m.id) FROM messages m JOIN users mu ON mu.id=m.user_id LEFT JOIN roles mr ON mr.id=mu.role_id WHERE m.service_request_id=s.id),'[]') messages,
    COALESCE((SELECT json_agg(json_build_object('title',h.comment,'desc',h.comment,'data',to_char(h.created_at,'DD/MM/YYYY HH24:MI'),'date',to_char(h.created_at,'DD/MM/YYYY HH24:MI')) ORDER BY h.id) FROM service_request_status_histories h WHERE h.service_request_id=s.id),'[]') timeline
    FROM service_requests s JOIN customers cu ON cu.id=s.customer_id JOIN users cuu ON cuu.id=cu.user_id JOIN business_units b ON b.id=s.business_unit_id LEFT JOIN employees e ON e.id=s.assigned_to LEFT JOIN users eu ON eu.id=e.user_id
    WHERE s.deleted_at IS NULL AND ($2::boolean OR cu.user_id=$1 OR ($3::boolean AND (s.assigned_to=$4 OR s.business_unit_id=$5))) ORDER BY s.id DESC LIMIT 200`, [uid, isAdmin, isStaff, eid, eunit]);
  return rows.map((r) => ({ ...r, titulo: r.title, descricao: r.description, cliente: r.company_name || r.customer_name, empresa: r.company_name || r.trade_name || r.customer_name, servico: r.unit, responsavel: r.responsible || "Por atribuir", status_key: r.status, status: labels[r.status] ?? r.status, statusLabel: labels[r.status] ?? r.status, sc: "s-analise", dot: "bg-blue-500", unitBadge: "bg-slate-100 text-slate-700" }));
}
__name(list, "list");
requests.get("/solicitacoes/conversas", async (c) => c.json({ success: true, requests: await list(c) }));
requests.get("/api/requests/:id", async (c) => {
  const r = await accessible(c, c.req.param("id"));
  const db = c.get("db");
  return c.json({ request: r, messages: await db.query("SELECT m.id,m.message,m.created_at,u.name FROM messages m JOIN users u ON u.id=m.user_id WHERE service_request_id=$1 ORDER BY m.id", [r.id]), history: await db.query("SELECT * FROM service_request_status_histories WHERE service_request_id=$1 ORDER BY id", [r.id]), files: await db.query("SELECT id,name,mime_type,created_at FROM worker_attachments WHERE service_request_id=$1", [r.id]) });
});
requests.post("/solicitacoes/nova", async (c) => {
  const u = user(c), d = await body(c), cid = await customer(c), db = c.get("db");
  const title = text(d, "title"), description = text(d, "description", 3e3), unit = integer(d.unit_id ?? d.business_unit_id, 1);
  const priorities = { baixa: "low", media: "normal", alta: "high", urgente: "urgent" };
  const priority = choice(priorities[d.priority] ?? d.priority, ["low", "normal", "high", "urgent"], "normal");
  const r = await db.transaction(async () => {
    if (!await db.one("SELECT id FROM business_units WHERE id=$1 AND status='active' AND deleted_at IS NULL", [unit])) return fail(422, "Unidade inv\xE1lida.");
    const service = d.service_id ? integer(d.service_id) : null;
    if (service && !await db.one("SELECT id FROM services WHERE id=$1 AND business_unit_id=$2 AND deleted_at IS NULL AND status='active'", [service, unit])) return fail(422, "Servi\xE7o inv\xE1lido.");
    const seq = await db.one("SELECT nextval(pg_get_serial_sequence('service_requests','id')) id");
    const protocol = `SOL-${(/* @__PURE__ */ new Date()).getUTCFullYear()}-${String(seq.id).padStart(6, "0")}`;
    const r2 = await db.one(`INSERT INTO service_requests(id,protocol,customer_id,business_unit_id,service_id,title,description,priority,status,requested_date,created_at,updated_at) VALUES($1,$2,$3,$4,$5,$6,$7,$8,'new',CURRENT_DATE,now(),now()) RETURNING *`, [seq.id, protocol, cid, unit, service, title, description, priority]);
    await db.query("INSERT INTO service_request_status_histories(service_request_id,user_id,new_status,comment,created_at) VALUES($1,$2,'new','Solicita\xE7\xE3o registada pelo cliente.',now())", [r2.id, u.id]);
    return r2;
  });
  return done(c, { request: r, message: "Solicita\xE7\xE3o registada." });
});
requests.post("/solicitacoes/:id/mensagem", async (c) => {
  const u = c.get("user"), d = await body(c), r = await accessible(c, c.req.param("id"));
  const senderName = u ? u.name : "Super Administrador RACHI";
  const uid = u ? u.id : 1;
  const isStaffSender = !u || staff(u);
  const m = await c.get("db").one("INSERT INTO messages(service_request_id,user_id,message,created_at,updated_at) VALUES($1,$2,$3,now(),now()) RETURNING id,message,created_at", [r.id, uid, text(d, "message", 3e3)]);
  return done(c, { message: { ...m, text: m.message, nome: senderName, sender: senderName, is_staff: isStaffSender, fromUser: !isStaffSender } });
});
requests.post("/api/requests/:id/status", async (c) => {
  const u = c.get("user"), d = await body(c), db = c.get("db");
  if (!u || !admin(u) && !staff(u)) return fail(403, "Apenas administradores ou colaboradores podem alterar o estado.");
  const status = choice(d.status, Object.keys(labels)), comment = text(d, "comment", 3e3, false);
  const actorId = u ? u.id : 1;
  await db.transaction(async () => {
    const r = await accessible(c, c.req.param("id"), true);
    if (r.status === "completed" && status === "new" && !admin(u)) return fail(403, "Apenas administradores podem reabrir uma solicita\xE7\xE3o conclu\xEDda.");
    await db.query(`UPDATE service_requests SET status=$1::text,updated_at=now(),completed_at=CASE WHEN $1::text='completed' THEN now() ELSE completed_at END,cancelled_at=CASE WHEN $1::text='cancelled' THEN now() ELSE cancelled_at END WHERE id=$2::integer`, [status, r.id]);
    await db.query("INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at) VALUES($1,$2,$3,$4,$5,now())", [r.id, actorId, r.status, status, comment || `Estado alterado para ${labels[status]}.`]);
  });
  return done(c, {});
});
requests.post("/api/requests/:id/assign", async (c) => {
  const u = user(c, "staff"), db = c.get("db");
  if (!u.employee_id) return fail(422, "Perfil de funcion\xE1rio necess\xE1rio.");
  await db.transaction(async () => {
    const r = await accessible(c, c.req.param("id"), true);
    if (r.assigned_to && r.assigned_to !== u.employee_id && !admin(u)) return fail(409, "Solicita\xE7\xE3o atribu\xEDda a outro funcion\xE1rio.");
    await db.query("UPDATE service_requests SET assigned_to=$1,status='in_analysis',updated_at=now() WHERE id=$2", [u.employee_id, r.id]);
    await db.query("INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at) VALUES($1,$2,$3,'in_analysis','Funcion\xE1rio assumiu o atendimento.',now())", [r.id, u.id, r.status]);
  });
  return done(c, {});
});
requests.post("/api/requests/:id/files", async (c) => {
  const u = user(c), r = await accessible(c, c.req.param("id"));
  const data = await c.req.formData();
  const file = data.get("file");
  if (!file || typeof file === "string" || file.size > 25 * 1024 * 1024 || file.size === 0) return fail(422, "Anexe um arquivo de at\xE9 25 MB.");
  const ext = file.name.split(".").pop()?.toLowerCase();
  if (!ext || !["jpg", "jpeg", "png", "webp", "pdf", "docx", "zip", "ai", "psd"].includes(ext)) return fail(422, "Formato n\xE3o permitido.");
  const row = await c.get("db").one("INSERT INTO worker_attachments(service_request_id,user_id,name,mime_type,content) VALUES($1,$2,$3,$4,$5) RETURNING id", [r.id, u.id, file.name.slice(0, 255), "application/octet-stream", Buffer.from(await file.arrayBuffer())]);
  return c.json({ success: true, file: row });
});
requests.get("/api/files/:id", async (c) => {
  user(c);
  const db = c.get("db"), metadata = await db.one("SELECT id,service_request_id,name FROM worker_attachments WHERE id=$1", [integer(c.req.param("id"))]);
  if (!metadata) return fail(404, "Arquivo n\xE3o encontrado.");
  await accessible(c, String(metadata.service_request_id));
  const file = await db.one("SELECT content FROM worker_attachments WHERE id=$1", [metadata.id]);
  return new Response(new Uint8Array(file.content), { headers: { "Content-Type": "application/octet-stream", "Content-Disposition": `attachment; filename*=UTF-8''${encodeURIComponent(metadata.name)}`, "Cache-Control": "private, no-store", "X-Content-Type-Options": "nosniff" } });
});

// worker/admin.ts
var management = new Hono2();
management.use("/admin/*", async (c, next) => {
  user(c, "admin");
  await next();
});
var safeUsers = `SELECT u.id, u.name, u.name nome, u.email, u.phone, u.phone telefone, u.status, u.role_id, u.created_at, u.deleted_at, r.name role, r.slug role_slug FROM users u LEFT JOIN roles r ON r.id=u.role_id WHERE u.deleted_at IS NULL`;
function formatUser(row) {
  const name = row.name || row.nome || "Utilizador";
  const roleSlug = row.role_slug || "customer";
  const roleName = row.role || "Cliente";
  const rawStatus = row.status || "active";
  const statusLabel = rawStatus === "active" ? "Ativo" : rawStatus === "blocked" ? "Bloqueado" : "Inativo";
  const sk = rawStatus === "active" ? "ativo" : "bloqueado";
  const isDeleted = !!row.deleted_at;
  const initials = name.trim().split(/\s+/).filter(Boolean).slice(0, 2).map((n) => n[0]).join("").toUpperCase() || "U";
  const roleMeta = {
    super_admin: {
      tipo: "Admin Master",
      tc: "bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300",
      mod: ["Todos os M\xF3dulos"],
      av: "bg-gradient-to-br from-blue-600 to-indigo-700"
    },
    admin: {
      tipo: "Administrador",
      tc: "bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300",
      mod: ["Gest\xE3o Geral", "Relat\xF3rios", "Utilizadores"],
      av: "bg-gradient-to-br from-indigo-600 to-purple-700"
    },
    customer: {
      tipo: "Cliente",
      tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300",
      mod: ["Loja", "Autoatendimento"],
      av: "bg-gradient-to-br from-slate-500 to-gray-600"
    },
    student: {
      tipo: "Aluno",
      tc: "bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-300",
      mod: ["Academy", "Cursos"],
      av: "bg-gradient-to-br from-sky-600 to-cyan-700"
    }
  };
  const meta = roleMeta[roleSlug] || {
    tipo: roleName,
    tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300",
    mod: ["Geral"],
    av: "bg-gradient-to-br from-slate-400 to-slate-500"
  };
  let formattedDate = "2026";
  if (row.created_at) {
    if (typeof row.created_at === "string") {
      formattedDate = row.created_at.slice(0, 10).split("-").reverse().join("/");
    } else {
      try {
        formattedDate = new Date(row.created_at).toLocaleDateString("pt-PT");
      } catch {
        formattedDate = "2026";
      }
    }
  }
  return {
    id: row.id,
    name,
    nome: name,
    email: row.email,
    phone: row.phone || row.telefone || "",
    telefone: row.phone || row.telefone || "",
    role_id: row.role_id,
    role: roleName,
    role_slug: roleSlug,
    tipo: meta.tipo,
    tc: meta.tc,
    mod: meta.mod,
    av: meta.av,
    ini: initials,
    status: statusLabel,
    raw_status: rawStatus,
    sk,
    is_deleted: isDeleted,
    deleted_at: row.deleted_at ? String(row.deleted_at).slice(0, 10) : null,
    ua: "Hoje",
    created_at: formattedDate
  };
}
__name(formatUser, "formatUser");
async function logActivity(db, actorId, action, modelType, modelId, description, req) {
  try {
    const ip = req.header("cf-connecting-ip") || req.header("x-forwarded-for") || "127.0.0.1";
    const ua = req.header("user-agent") || "Browser";
    await db.query(
      `INSERT INTO activity_logs(user_id, action, model_type, model_id, description, ip_address, user_agent, created_at)
       VALUES($1, $2, $3, $4, $5, $6, $7, now())`,
      [actorId, action, modelType, modelId, description, String(ip).slice(0, 45), ua]
    );
  } catch (err) {
    console.error("Failed to write activity_log:", err);
  }
}
__name(logActivity, "logActivity");
async function permittedRole(c, id) {
  const role = await c.get("db").one("SELECT id, slug FROM roles WHERE id=$1", [integer(id)]);
  if (!role) return fail(422, "Perfil inv\xE1lido.");
  if (role.slug === "super_admin" && user(c).role_slug !== "super_admin") return fail(403, "Apenas o administrador principal pode atribuir este perfil.");
  return role.id;
}
__name(permittedRole, "permittedRole");
async function target(c) {
  const u = await c.get("db").one(
    `SELECT u.id, u.name, u.email, u.role_id, r.slug FROM users u LEFT JOIN roles r ON r.id=u.role_id WHERE u.id=$1 AND u.deleted_at IS NULL`,
    [integer(c.req.param("id"))]
  );
  if (!u) return fail(404, "Utilizador n\xE3o encontrado.");
  if (u.slug === "super_admin" && user(c).role_slug !== "super_admin") return fail(403, "Perfil protegido.");
  return u;
}
__name(target, "target");
management.get("/admin/users", async (c) => {
  const db = c.get("db");
  const rows = await db.query(safeUsers + " ORDER BY u.id DESC");
  const users = rows.map(formatUser);
  const roles = await db.query("SELECT id, name, slug, description FROM roles WHERE slug IN ('super_admin','admin','customer','student') ORDER BY id");
  return c.json({ success: true, users, roles });
});
management.post("/admin/users", async (c) => {
  const d = await body(c), db = c.get("db"), roleId = await permittedRole(c, d.role_id), password = text(d, "password", 72);
  if (password.length < 10 || new TextEncoder().encode(password).length > 72) return fail(422, "A palavra-passe deve ter de 10 a 72 bytes.");
  const roleRow = await db.one("SELECT slug FROM roles WHERE id=$1", [roleId]);
  const roleSlug = roleRow?.slug || "customer";
  const uName = text({ ...d, name: d.name ?? d.nome }, "name");
  const uEmail = email(d);
  const uPhone = text({ ...d, phone: d.phone ?? d.telefone }, "phone", 30, false);
  const uStatus = choice(d.status, ["active", "inactive", "blocked"], "active");
  const currentUser = user(c);
  const inserted = await db.transaction(async () => {
    const row = await db.one(
      `INSERT INTO users(name, email, password, phone, role_id, status, created_at, updated_at)
       VALUES($1, $2, extensions.crypt($3, extensions.gen_salt('bf', 12)), $4, $5, $6, now(), now())
       RETURNING id`,
      [uName, uEmail, password, uPhone, roleId, uStatus]
    );
    if (["customer", "student"].includes(roleSlug)) {
      await db.query(
        `INSERT INTO customers(user_id, phone, type, status, created_at, updated_at)
         VALUES($1, $2, 'individual', 'active', now(), now())
         ON CONFLICT (user_id) DO UPDATE SET phone=EXCLUDED.phone, deleted_at=NULL`,
        [row.id, uPhone]
      );
    }
    return row;
  });
  const fullRow = await db.one(safeUsers + " AND u.id=$1", [inserted.id]);
  const formatted = formatUser(fullRow);
  await logActivity(db, currentUser.id, "user_created", "App\\Models\\User", formatted.id, `Utilizador ${formatted.nome} (${formatted.email}) criado com o perfil ${formatted.tipo}.`, c.req);
  return done(c, { user: formatted, message: `Utilizador ${formatted.nome} criado com sucesso!` });
});
management.post("/admin/users/:id/update", async (c) => {
  const t = await target(c), d = await body(c), db = c.get("db"), currentUser = user(c);
  if (t.id === currentUser.id && (d.role_id && integer(d.role_id) !== t.role_id || d.status && d.status !== "active")) {
    return fail(422, "N\xE3o pode remover o seu pr\xF3prio acesso.");
  }
  const role = d.role_id ? await permittedRole(c, d.role_id) : null;
  await db.transaction(async () => {
    await db.query(
      `UPDATE users SET name=COALESCE($2,name), email=COALESCE($3,email), phone=COALESCE($4,phone), role_id=COALESCE($5,role_id), status=COALESCE($6,status), updated_at=now() WHERE id=$1`,
      [
        t.id,
        d.name || d.nome ? text({ ...d, name: d.name ?? d.nome }, "name") : null,
        d.email ? email(d) : null,
        d.phone !== void 0 || d.telefone !== void 0 ? text({ ...d, phone: d.phone ?? d.telefone }, "phone", 30, false) : null,
        role,
        d.status ? choice(d.status, ["active", "inactive", "blocked"]) : null
      ]
    );
    if (d.password) {
      const password = text(d, "password", 72);
      if (password.length < 10 || new TextEncoder().encode(password).length > 72) return fail(422, "Palavra-passe inv\xE1lida.");
      await db.query("UPDATE users SET password=extensions.crypt($1,extensions.gen_salt('bf',12)) WHERE id=$2", [password, t.id]);
    }
    await db.query("DELETE FROM worker_sessions WHERE user_id=$1", [t.id]);
  });
  const fullRow = await db.one(safeUsers + " AND u.id=$1", [t.id]);
  const formatted = formatUser(fullRow);
  await logActivity(db, currentUser.id, "user_updated", "App\\Models\\User", formatted.id, `Dados e perfil do utilizador ${formatted.nome} (${formatted.email}) atualizados para ${formatted.tipo}.`, c.req);
  return done(c, { user: formatted, message: `Utilizador ${formatted.nome} atualizado com sucesso!` });
});
management.post("/admin/users/:id/toggle-status", async (c) => {
  const t = await target(c), currentUser = user(c), db = c.get("db");
  if (t.id === currentUser.id || t.slug === "super_admin") return fail(403, "Utilizador protegido.");
  await db.transaction(async () => {
    await db.query("UPDATE users SET status=CASE WHEN status='active' THEN 'blocked' ELSE 'active' END, updated_at=now() WHERE id=$1", [t.id]);
    await db.query("DELETE FROM worker_sessions WHERE user_id=$1", [t.id]);
  });
  const fullRow = await db.one(safeUsers + " AND u.id=$1", [t.id]);
  const formatted = formatUser(fullRow);
  await logActivity(db, currentUser.id, "status_changed", "App\\Models\\User", formatted.id, `Estado do utilizador ${formatted.nome} alterado para ${formatted.status}.`, c.req);
  return done(c, { user: formatted, message: `Estado de ${formatted.nome} alterado para ${formatted.status}!` });
});
management.post("/admin/users/:id/reset-password", async (c) => {
  const t = await target(c), d = await body(c), currentUser = user(c), db = c.get("db");
  const password = d.password ? text(d, "password", 72) : randomToken().slice(0, 20);
  if (password.length < 10 || new TextEncoder().encode(password).length > 72) return fail(422, "Palavra-passe inv\xE1lida.");
  await db.transaction(async () => {
    await db.query("UPDATE users SET password=extensions.crypt($1,extensions.gen_salt('bf',12)), updated_at=now() WHERE id=$2", [password, t.id]);
    await db.query("DELETE FROM worker_sessions WHERE user_id=$1", [t.id]);
  });
  await logActivity(db, currentUser.id, "password_reset", "App\\Models\\User", t.id, `Palavra-passe do utilizador ${t.name || "#" + t.id} redefinida pelo administrador.`, c.req);
  return c.json({ success: true, new_password: password, message: "Palavra-passe redefinida com sucesso!" });
});
management.on(["POST", "DELETE"], "/admin/users/:id/delete", async (c) => {
  const id = integer(c.req.param("id"));
  const db = c.get("db");
  const u = await db.one(
    `SELECT u.id, u.name, u.email, u.role_id, u.deleted_at, r.slug FROM users u LEFT JOIN roles r ON r.id=u.role_id WHERE u.id=$1`,
    [id]
  );
  if (!u) {
    return done(c, { message: "Utilizador removido do registo." });
  }
  if (u.deleted_at) {
    return done(c, { message: "O utilizador j\xE1 se encontrava exclu\xEDdo." });
  }
  const currentUser = user(c);
  if (u.id === currentUser.id || u.slug === "super_admin") return fail(403, "Utilizador protegido.");
  await db.transaction(async () => {
    await db.query("UPDATE users SET deleted_at=now(), status='blocked', updated_at=now() WHERE id=$1", [u.id]);
    await db.query("UPDATE customers SET deleted_at=now() WHERE user_id=$1", [u.id]);
    await db.query("DELETE FROM worker_sessions WHERE user_id=$1", [u.id]);
  });
  await logActivity(db, currentUser.id, "user_deleted", "App\\Models\\User", u.id, `Utilizador ${u.name || "#" + u.id} (${u.email || ""}) exclu\xEDdo pelo administrador.`, c.req);
  return done(c, { message: `Utilizador ${u.name || ""} exclu\xEDdo com sucesso!` });
});
management.get("/admin/academy/enrollments", async (c) => c.json({
  enrollments: await c.get("db").query(`SELECT e.id, e.customer_id aluno_id, u.id user_id, u.name nome, u.email, cu.phone telefone, c.name curso, c.slug curso_slug, c.id curso_id, e.status, to_char(e.created_at,'DD/MM/YYYY HH24:MI') data, 'RAC-'||lpad(e.id::text,5,'0') codigo FROM course_enrollments e JOIN customers cu ON cu.id=e.customer_id JOIN users u ON u.id=cu.user_id JOIN courses c ON c.id=e.course_id WHERE cu.deleted_at IS NULL AND u.deleted_at IS NULL ORDER BY e.id DESC`)
}));
management.post("/admin/academy/enrollments/:id/status", async (c) => {
  const d = await body(c);
  const row = await c.get("db").one("UPDATE course_enrollments SET status=$1, updated_at=now() WHERE id=$2 RETURNING id, status", [choice(d.status, ["pending", "active", "completed", "cancelled", "expired"]), integer(c.req.param("id"))]);
  if (!row) return fail(404, "Matr\xEDcula n\xE3o encontrada.");
  return done(c, { enrollment: row });
});
management.on(["POST", "DELETE"], "/admin/academy/enrollments/:id/delete", async (c) => {
  await c.get("db").query("DELETE FROM course_enrollments WHERE id=$1", [integer(c.req.param("id"))]);
  return done(c, {});
});
management.post("/admin/academy/enrollments/create", async (c) => {
  const d = await body(c), db = c.get("db");
  const row = await db.transaction(async () => {
    const u = d.user_id ? await db.one("SELECT id FROM users WHERE id=$1 AND deleted_at IS NULL", [integer(d.user_id)]) : await db.one("SELECT id FROM users WHERE lower(email)=$1 AND deleted_at IS NULL", [email(d)]);
    if (!u) return fail(422, "Crie primeiro o utilizador com uma palavra-passe segura.");
    await db.query("SELECT id FROM users WHERE id=$1 FOR UPDATE", [u.id]);
    const cu = await db.one(`INSERT INTO customers(user_id, type, phone, status, created_at, updated_at) VALUES($1, 'individual', $2, 'active', now(), now()) ON CONFLICT(user_id) DO UPDATE SET phone=EXCLUDED.phone, deleted_at=NULL RETURNING id`, [u.id, text(d, "phone", 30, false)]);
    const course = integer(d.course_id), status = choice(d.status, ["active", "pending"], "pending");
    if (!await db.one("SELECT id FROM courses WHERE id=$1 AND deleted_at IS NULL", [course])) return fail(422, "Curso inv\xE1lido.");
    const existing = await db.one("SELECT id FROM course_enrollments WHERE customer_id=$1 AND course_id=$2", [cu.id, course]);
    if (existing) return fail(409, "Utilizador j\xE1 inscrito.");
    return db.one("INSERT INTO course_enrollments(course_id, customer_id, status, enrolled_at, created_at, updated_at) VALUES($1, $2, $3, now(), now(), now()) RETURNING id, status", [course, cu.id, status]);
  });
  return done(c, { enrollment: row });
});
management.get("/admin/data/:entity", async (c) => {
  const sql = {
    employees: "SELECT e.id, u.name, u.email, e.position, e.department, e.status FROM employees e JOIN users u ON u.id=e.user_id WHERE e.deleted_at IS NULL",
    customers: "SELECT cu.id, u.name, u.email, cu.company_name, cu.phone, cu.status FROM customers cu JOIN users u ON u.id=cu.user_id WHERE cu.deleted_at IS NULL",
    products: "SELECT id, name, sku, price, stock_quantity, minimum_stock, status FROM products WHERE deleted_at IS NULL",
    services: "SELECT id, name, base_price, status FROM services WHERE deleted_at IS NULL",
    courses: "SELECT id, name, slug, price, status, duration_hours FROM courses WHERE deleted_at IS NULL",
    contacts: "SELECT id, name, email, phone, subject, message, created_at FROM worker_contacts ORDER BY id DESC LIMIT 200",
    audit: "SELECT a.id, a.action, a.description, to_char(a.created_at, 'DD/MM/YYYY HH24:MI') data, COALESCE(u.name, 'Sistema') autor, a.ip_address FROM activity_logs a LEFT JOIN users u ON u.id=a.user_id ORDER BY a.id DESC LIMIT 100",
    reports: "SELECT (SELECT count(*) FROM users WHERE deleted_at IS NULL) users, (SELECT count(*) FROM service_requests WHERE deleted_at IS NULL) requests, (SELECT count(*) FROM course_enrollments) enrollments, (SELECT COALESCE(sum(total),0) FROM orders WHERE payment_status='paid') revenue"
  };
  const query = sql[c.req.param("entity")];
  if (!query) return fail(404, "Recurso n\xE3o encontrado.");
  return c.json({ items: await c.get("db").query(query) });
});
management.get("/api/stock", async (c) => {
  user(c, "staff");
  return c.json({ products: await c.get("db").query("SELECT id, name, sku, stock_quantity, minimum_stock FROM products WHERE deleted_at IS NULL ORDER BY name") });
});

// worker/commerce.ts
var commerce = new Hono2();
function cents(value) {
  if (!/^\d+(\.\d{1,2})?$/.test(String(value))) return fail(422, "Valor monet\xE1rio inv\xE1lido.");
  const n = Math.round(Number(value) * 100);
  if (!Number.isSafeInteger(n) || n > 1e12) return fail(422, "Valor fora do limite.");
  return n;
}
__name(cents, "cents");
commerce.post("/checkout", async (c) => {
  const u = user(c), d = await body(c), db = c.get("db"), cid = await customer(c);
  if (!Array.isArray(d.items) || !d.items.length || d.items.length > 100) return fail(422, "Carrinho inv\xE1lido.");
  const quantities = /* @__PURE__ */ new Map();
  for (const item of d.items) {
    const id = integer(item.product_id), n = integer(item.quantity);
    if (n > 1e3) return fail(422, "Quantidade muito elevada.");
    quantities.set(id, (quantities.get(id) ?? 0) + n);
  }
  const method = choice(d.payment_method, ["multicaixa", "manual"], "manual");
  const order2 = await db.transaction(async () => {
    const products = await db.query("SELECT * FROM products WHERE id=ANY($1::bigint[]) AND status='active' AND deleted_at IS NULL ORDER BY id FOR UPDATE", [[...quantities.keys()].sort((a, b) => a - b)]);
    if (products.length !== quantities.size) return fail(422, "Produto indispon\xEDvel.");
    if (new Set(products.map((p) => p.business_unit_id)).size !== 1) return fail(422, "Fa\xE7a um pedido separado por unidade de neg\xF3cio.");
    let total = 0;
    for (const p of products) {
      if (p.stock_quantity < quantities.get(p.id)) return fail(409, `Estoque insuficiente: ${p.name}.`);
      total += cents(p.price) * quantities.get(p.id);
    }
    if (!Number.isSafeInteger(total)) return fail(422, "Total inv\xE1lido.");
    for (const key of ["shipping_address_id", "billing_address_id"]) if (d[key] && !await db.one("SELECT id FROM addresses WHERE id=$1 AND user_id=$2", [integer(d[key]), u.id])) return fail(403, "Endere\xE7o n\xE3o pertence \xE0 sua conta.");
    const seq = await db.one("SELECT nextval(pg_get_serial_sequence('orders','id')) id");
    const number = `PED-${(/* @__PURE__ */ new Date()).getUTCFullYear()}-${String(seq.id).padStart(6, "0")}`;
    const order3 = await db.one(`INSERT INTO orders(id,number,customer_id,business_unit_id,status,payment_status,subtotal,total,shipping_address_id,billing_address_id,notes,created_at,updated_at)
    VALUES($1,$2,$3,$4,'pending','pending',$5,$5,$6,$7,$8,now(),now()) RETURNING id,number,total,status`, [seq.id, number, cid, products[0].business_unit_id, (total / 100).toFixed(2), d.shipping_address_id ?? null, d.billing_address_id ?? null, text(d, "notes", 3e3, false)]);
    for (const p of products) {
      const n = quantities.get(p.id);
      await db.query("INSERT INTO order_items(order_id,product_id,name,sku,quantity,unit_price,total,created_at,updated_at) VALUES($1,$2,$3,$4,$5,$6,$7,now(),now())", [order3.id, p.id, p.name, p.sku, n, p.price, (cents(p.price) * n / 100).toFixed(2)]);
      await db.query("UPDATE products SET stock_quantity=stock_quantity-$1,updated_at=now() WHERE id=$2", [n, p.id]);
      await db.query("INSERT INTO stock_movements(product_id,user_id,type,quantity,previous_quantity,current_quantity,reason,reference_type,reference_id,created_at) VALUES($1,$2,'sale',$3,$4,$5,$6,'App\\Models\\Order',$7,now())", [p.id, u.id, -n, p.stock_quantity, p.stock_quantity - n, number, order3.id]);
    }
    await db.query("INSERT INTO payments(order_id,method,amount,status,created_at,updated_at) VALUES($1,$2,$3,'pending',now(),now())", [order3.id, method, (total / 100).toFixed(2)]);
    return order3;
  });
  return done(c, { order: order2, message: "Pedido registado. Pagamento pendente de confirma\xE7\xE3o." });
});
commerce.get("/api/orders", async (c) => {
  const u = user(c);
  return c.json({ orders: await c.get("db").query(`SELECT o.*,COALESCE((SELECT json_agg(i ORDER BY id) FROM order_items i WHERE i.order_id=o.id),'[]') items FROM orders o JOIN customers cu ON cu.id=o.customer_id WHERE cu.user_id=$1 OR $2::boolean ORDER BY o.id DESC LIMIT 200`, [u.id, admin(u)]) });
});
commerce.post("/api/orders/:id/paid", async (c) => {
  user(c, "admin");
  const db = c.get("db"), id = integer(c.req.param("id")), d = await body(c);
  await db.transaction(async () => {
    const o = await db.one("SELECT id,status FROM orders WHERE id=$1 FOR UPDATE", [id]);
    if (!o) return fail(404, "Pedido n\xE3o encontrado.");
    if (o.status === "cancelled") return fail(409, "Pedido cancelado.");
    await db.query("UPDATE orders SET payment_status='paid',status='processing',updated_at=now() WHERE id=$1", [id]);
    await db.query("UPDATE payments SET status='approved',paid_at=now(),transaction_id=$2,updated_at=now() WHERE order_id=$1", [id, text(d, "transaction_id", 255, false)]);
  });
  return done(c, {});
});
commerce.get("/api/quotes", async (c) => {
  const u = user(c);
  return c.json({ quotes: await c.get("db").query(`SELECT q.*,COALESCE((SELECT json_agg(i ORDER BY id) FROM quote_items i WHERE i.quote_id=q.id),'[]') items FROM quotes q JOIN customers cu ON cu.id=q.customer_id WHERE cu.user_id=$1 OR $2::boolean OR q.created_by=$1 ORDER BY q.id DESC LIMIT 200`, [u.id, admin(u)]) });
});
commerce.post("/funcionario/orcamentos", async (c) => {
  const u = user(c, "staff"), d = await body(c), db = c.get("db");
  if (!Array.isArray(d.items) || d.items.length < 1 || d.items.length > 50) return fail(422, "Itens inv\xE1lidos.");
  const items = d.items.map((i) => ({ description: text(i, "description"), quantity: integer(i.quantity), price: cents(i.unit_price) }));
  const subtotal = items.reduce((sum, i) => sum + i.quantity * i.price, 0), discount = cents(d.discount ?? 0);
  if (discount > subtotal) return fail(422, "Desconto maior que o subtotal.");
  const row = await db.transaction(async () => {
    const request = d.service_request_id ? await accessible(c, String(d.service_request_id), true) : null;
    if (!request && !admin(u)) return fail(403, "Vincule o or\xE7amento a uma solicita\xE7\xE3o acess\xEDvel.");
    const cid = request?.customer_id ?? integer(d.customer_id), unit = request?.business_unit_id ?? integer(d.business_unit_id);
    const seq = await db.one("SELECT nextval(pg_get_serial_sequence('quotes','id')) id"), number = `ORC-${(/* @__PURE__ */ new Date()).getUTCFullYear()}-${String(seq.id).padStart(6, "0")}`;
    const valid = d.valid_until || new Date(Date.now() + 15 * 864e5).toISOString().slice(0, 10);
    if (!/^\d{4}-\d{2}-\d{2}$/.test(valid)) return fail(422, "Data inv\xE1lida.");
    const q = await db.one(`INSERT INTO quotes(id,number,service_request_id,customer_id,business_unit_id,created_by,subtotal,discount,total,valid_until,status,notes,created_at,updated_at) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,'sent',$11,now(),now()) RETURNING *`, [seq.id, number, request?.id ?? null, cid, unit, u.id, (subtotal / 100).toFixed(2), (discount / 100).toFixed(2), ((subtotal - discount) / 100).toFixed(2), valid, text(d, "notes", 3e3, false)]);
    for (const item of items) await db.query("INSERT INTO quote_items(quote_id,description,quantity,unit_price,total,created_at,updated_at) VALUES($1,$2,$3,$4,$5,now(),now())", [q.id, item.description, item.quantity, (item.price / 100).toFixed(2), (item.price * item.quantity / 100).toFixed(2)]);
    if (request && ["new", "in_analysis"].includes(request.status)) {
      await db.query("UPDATE service_requests SET status='quoted',updated_at=now() WHERE id=$1", [request.id]);
      await db.query("INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at) VALUES($1,$2,$3,'quoted',$4,now())", [request.id, u.id, request.status, `Or\xE7amento ${number} emitido.`]);
    }
    return q;
  });
  return done(c, { quote: row });
});
commerce.post("/cliente/orcamentos/:id/aprovar", async (c) => {
  const u = user(c), db = c.get("db");
  await db.transaction(async () => {
    const q = await db.one("SELECT q.*,cu.user_id FROM quotes q JOIN customers cu ON cu.id=q.customer_id WHERE q.id=$1 FOR UPDATE OF q", [integer(c.req.param("id"))]);
    if (!q) return fail(404, "Or\xE7amento n\xE3o encontrado.");
    if (q.user_id !== u.id) return fail(403, "Acesso n\xE3o autorizado.");
    if (q.status === "approved") return;
    if (!["sent", "viewed"].includes(q.status) || new Date(q.valid_until).getTime() < new Date((/* @__PURE__ */ new Date()).toISOString().slice(0, 10)).getTime()) return fail(409, "Or\xE7amento expirado ou indispon\xEDvel.");
    await db.query("UPDATE quotes SET status='approved',updated_at=now() WHERE id=$1", [q.id]);
    if (q.service_request_id) {
      const r = await db.one("SELECT status FROM service_requests WHERE id=$1 FOR UPDATE", [q.service_request_id]);
      await db.query("UPDATE service_requests SET status='approved',updated_at=now() WHERE id=$1", [q.service_request_id]);
      await db.query("INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at) VALUES($1,$2,$3,'approved','Or\xE7amento aprovado pelo cliente.',now())", [q.service_request_id, u.id, r.status]);
    }
  });
  return done(c, {});
});

// worker/views.ts
function shell(title, content) {
  return `<!doctype html><html lang="pt"><head><link rel="stylesheet" href="/toast.css"><script src="/toast.js"><\/script><script src="/auth-session.js"><\/script><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>${title} \xB7 RACHI</title><link rel="stylesheet" href="/worker.css"><script src="/worker-ui.js" defer><\/script></head><body><header><a class="brand" href="/">RACHI<span>Solu\xE7\xF5es inteligentes</span></a><nav><a href="/loja">Loja</a><a href="/academy/cursos">Academy</a><a href="/portal">Minha conta</a></nav></header><main>${content}</main><footer>RACHI \xB7 Tecnologia, forma\xE7\xE3o e servi\xE7os empresariais</footer></body></html>`;
}
__name(shell, "shell");
function loginPage(register = false) {
  const isRegister = register;
  return `<!doctype html>
<html lang="pt-AO" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Administrativo \xB7 RACHI</title>
  <meta name="description" content="Autentica\xE7\xE3o segura e gest\xE3o integrada das unidades TEC, PRINT, ACADEMY e HUMAN CAPITAL \u2014 RACHI.">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="/toast.css">
  <script src="/toast.js"><\/script>
  <script src="/auth-session.js"><\/script>

  <!-- Script Anti-Flash de Tema -->
  <script>
    (function() {
      var t = localStorage.getItem('rachi_theme');
      if (t === 'light') {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-theme', 'light');
      } else {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
      }
    })();

    window.toggleRachiTheme = function() {
      var isDark = document.documentElement.classList.toggle('dark');
      var t = isDark ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', t);
      localStorage.setItem('rachi_theme', t);
      var label = document.getElementById('theme-toggle-label');
      if (label) label.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';
      window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
      return isDark;
    };
  <\/script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    
    :root {
      --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      --font-heading: 'Outfit', 'Plus Jakarta Sans', sans-serif;
      
      --brand-blue: #0050f0;
      --brand-blue-hover: #0041c4;
      --brand-cyan: #00a3e0;
      --brand-gold: #f5a800;
      
      /* Modo Escuro (Padr\xE3o) */
      --bg-page: #060b17;
      --bg-sidebar: #091122;
      --bg-card: rgba(14, 24, 46, 0.95);
      --bg-input: rgba(6, 12, 24, 0.9);
      
      --border-subtle: rgba(255, 255, 255, 0.08);
      --border-card: rgba(255, 255, 255, 0.09);
      --border-hover: rgba(0, 163, 224, 0.4);
      --border-input: rgba(255, 255, 255, 0.14);
      
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --text-dim: #64748b;
      
      --input-focus-border: #00a3e0;
      --input-focus-ring: rgba(0, 163, 224, 0.25);
      
      --badge-admin-bg: rgba(0, 80, 240, 0.15);
      --badge-admin-border: rgba(0, 163, 224, 0.35);
      --badge-admin-text: #38bdf8;
      
      --badge-showcase-bg: rgba(245, 168, 0, 0.12);
      --badge-showcase-border: rgba(245, 168, 0, 0.3);
      --badge-showcase-text: #fbbf24;
      
      --shadow-sidebar: 15px 0 45px rgba(0, 0, 0, 0.35);
      --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
      
      --toggle-bg: rgba(255, 255, 255, 0.06);
      --toggle-border: rgba(255, 255, 255, 0.12);
      --toggle-text: #cbd5e1;
    }

    html:not(.dark) {
      /* Modo Claro */
      --bg-page: #f4f6fa;
      --bg-sidebar: #ffffff;
      --bg-card: #ffffff;
      --bg-input: #ffffff;
      
      --border-subtle: #e2e8f0;
      --border-card: #e5e9f2;
      --border-hover: rgba(0, 80, 240, 0.35);
      --border-input: #cbd5e1;
      
      --text-main: #0f172a;
      --text-muted: #475569;
      --text-dim: #64748b;
      
      --input-focus-border: #0050f0;
      --input-focus-ring: rgba(0, 80, 240, 0.18);
      
      --badge-admin-bg: rgba(0, 80, 240, 0.08);
      --badge-admin-border: rgba(0, 80, 240, 0.22);
      --badge-admin-text: #0050f0;
      
      --badge-showcase-bg: rgba(245, 168, 0, 0.1);
      --badge-showcase-border: rgba(245, 168, 0, 0.25);
      --badge-showcase-text: #b45309;
      
      --shadow-sidebar: 10px 0 35px rgba(15, 23, 42, 0.04);
      --shadow-card: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.03);
      
      --toggle-bg: #f1f5f9;
      --toggle-border: #cbd5e1;
      --toggle-text: #334155;
    }

    body {
      font-family: var(--font-sans);
      background-color: var(--bg-page);
      color: var(--text-main);
      min-height: 100vh;
      line-height: 1.5;
      display: flex;
      flex-direction: column;
      transition: background-color 0.25s ease, color 0.25s ease;
      background-image: 
        radial-gradient(at 0% 0%, rgba(0, 80, 240, 0.12) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(0, 163, 224, 0.09) 0px, transparent 50%);
      background-attachment: fixed;
    }

    /* Container Principal */
    .admin-login-layout {
      display: grid;
      grid-template-columns: minmax(380px, 470px) 1fr;
      min-height: 100vh;
      width: 100%;
    }

    /* COLUNA ESQUERDA: AUTENTICA\xC7\xC3O ADMINISTRATIVA */
    .auth-col {
      background-color: var(--bg-sidebar);
      border-right: 1px solid var(--border-subtle);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 2.75rem 2.75rem 2.25rem;
      position: relative;
      z-index: 10;
      box-shadow: var(--shadow-sidebar);
      transition: background-color 0.25s ease, border-color 0.25s ease;
    }

    .auth-header-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--text-muted);
      text-decoration: none;
      padding: 0.4rem 0.65rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }
    .back-link:hover {
      color: var(--brand-cyan);
      background: rgba(0, 163, 224, 0.08);
    }
    .back-link svg {
      transition: transform 0.2s ease;
    }
    .back-link:hover svg {
      transform: translateX(-3px);
    }

    .theme-toggle-btn {
      background: var(--toggle-bg);
      border: 1px solid var(--toggle-border);
      color: var(--toggle-text);
      padding: 0.45rem 0.85rem;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }
    .theme-toggle-btn:hover {
      border-color: var(--brand-cyan);
      color: var(--text-main);
      background: rgba(0, 163, 224, 0.1);
    }

    html:not(.dark) .icon-sun { display: none; }
    html.dark .icon-moon { display: none; }

    /* Logo & Marca */
    .brand-wrap {
      margin-bottom: 2rem;
    }
    .brand-logo-img {
      height: 38px;
      width: auto;
      max-width: 190px;
      display: block;
      object-fit: contain;
    }
    /* Regra do Logotipo Conforme o Tema:
       - No Modo Escuro (fundo escuro): exibe o logotipo claro/branco (.logo-for-dark)
       - No Modo Claro (fundo claro): exibe o logotipo escuro (.logo-for-light) */
    html.dark .logo-for-light { display: none !important; }
    html.dark .logo-for-dark { display: block !important; }
    html:not(.dark) .logo-for-light { display: block !important; }
    html:not(.dark) .logo-for-dark { display: none !important; }

    .auth-title {
      font-family: var(--font-heading);
      font-size: 1.85rem;
      font-weight: 800;
      color: var(--text-main);
      letter-spacing: -0.02em;
      line-height: 1.2;
      margin-top: 0.85rem;
      margin-bottom: 0.4rem;
    }
    .auth-desc {
      font-size: 0.875rem;
      color: var(--text-muted);
      line-height: 1.5;
      margin-bottom: 2rem;
    }

    /* Formul\xE1rio */
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.45rem;
    }
    .input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-icon {
      position: absolute;
      left: 1rem;
      width: 18px;
      height: 18px;
      color: var(--text-dim);
      pointer-events: none;
      transition: color 0.2s;
    }
    .form-control {
      width: 100%;
      padding: 0.825rem 1rem 0.825rem 2.75rem;
      font-family: var(--font-sans);
      font-size: 0.9rem;
      color: var(--text-main);
      background-color: var(--bg-input);
      border: 1.5px solid var(--border-input);
      border-radius: 11px;
      transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--input-focus-border);
      box-shadow: 0 0 0 3px var(--input-focus-ring);
    }
    .form-control::placeholder {
      color: var(--text-dim);
      font-size: 0.85rem;
    }
    .toggle-pass-btn {
      position: absolute;
      right: 0.75rem;
      background: none;
      border: none;
      color: var(--text-dim);
      cursor: pointer;
      padding: 0.4rem;
      border-radius: 6px;
      display: flex;
      align-items: center;
      transition: color 0.2s;
    }
    .toggle-pass-btn:hover {
      color: var(--text-main);
    }

    /* Op\xE7\xF5es Extras */
    .form-extras {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      font-size: 0.8125rem;
    }
    .remember-wrap {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      color: var(--text-muted);
      user-select: none;
    }
    .remember-wrap input[type="checkbox"] {
      width: 16px;
      height: 16px;
      border-radius: 4px;
      accent-color: var(--brand-blue);
      cursor: pointer;
    }
    .forgot-link {
      color: var(--brand-cyan);
      text-decoration: none;
      font-weight: 600;
    }
    .forgot-link:hover {
      text-decoration: underline;
    }

    /* Bot\xE3o Prim\xE1rio */
    .btn-submit {
      width: 100%;
      padding: 0.95rem 1.25rem;
      font-family: var(--font-sans);
      font-size: 0.925rem;
      font-weight: 700;
      color: #ffffff;
      background: linear-gradient(135deg, var(--brand-blue) 0%, #0077e6 100%);
      border: none;
      border-radius: 11px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      transition: all 0.2s ease;
      box-shadow: 0 4px 16px rgba(0, 80, 240, 0.35);
    }
    .btn-submit:hover:not(:disabled) {
      background: linear-gradient(135deg, var(--brand-blue-hover) 0%, #0066cc 100%);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(0, 80, 240, 0.45);
    }
    .btn-submit:disabled {
      opacity: 0.65;
      cursor: not-allowed;
      transform: none;
    }

    .spinner {
      width: 18px;
      height: 18px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: #ffffff;
      animation: spin 0.7s linear infinite;
      display: none;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* Mensagem de Feedback */
    .feedback-msg {
      margin-top: 1.25rem;
      padding: 0.85rem 1.1rem;
      border-radius: 10px;
      font-size: 0.825rem;
      display: none;
      line-height: 1.4;
    }
    .feedback-msg.error {
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #ef4444;
    }
    html.dark .feedback-msg.error {
      color: #f87171;
    }
    .feedback-msg.success {
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.35);
      color: #10b981;
    }
    html.dark .feedback-msg.success {
      color: #34d399;
    }

    .auth-footer {
      margin-top: 2.5rem;
      font-size: 0.72rem;
      color: var(--text-dim);
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    /* COLUNA DIREITA: APRESENTA\xC7\xC3O DO PROJETO RACHI */
    .showcase-col {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 4rem 5rem;
      position: relative;
      overflow-y: auto;
    }

    .showcase-header {
      max-width: 720px;
      margin-bottom: 2.5rem;
    }
    .showcase-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.35rem 0.85rem;
      border-radius: 9999px;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      background: var(--badge-showcase-bg);
      color: var(--badge-showcase-text);
      border: 1px solid var(--badge-showcase-border);
      margin-bottom: 1.25rem;
    }
    .showcase-heading {
      font-family: var(--font-heading);
      font-size: clamp(2rem, 2.7vw, 2.75rem);
      font-weight: 800;
      line-height: 1.2;
      color: var(--text-main);
      letter-spacing: -0.02em;
      margin-bottom: 1.15rem;
    }
    .showcase-heading span {
      background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-cyan) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    html.dark .showcase-heading span {
      background: linear-gradient(135deg, var(--brand-cyan) 0%, #60a5fa 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .showcase-lead {
      font-size: 1rem;
      color: var(--text-muted);
      line-height: 1.65;
    }

    /* Grid das 4 Unidades RACHI */
    .units-section-title {
      font-size: 0.75rem;
      font-weight: 800;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-dim);
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }
    .units-section-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border-subtle);
    }

    .units-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.35rem;
      max-width: 900px;
    }

    .unit-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: var(--shadow-card);
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .unit-card:hover {
      transform: translateY(-3px);
      border-color: var(--border-hover);
      box-shadow: 0 14px 30px -5px rgba(0, 0, 0, 0.15);
    }
    html.dark .unit-card:hover {
      box-shadow: 0 14px 30px -5px rgba(0, 0, 0, 0.4), 0 0 20px -5px rgba(0, 163, 224, 0.15);
    }

    .unit-card-header {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      margin-bottom: 0.85rem;
    }
    .unit-icon-box {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      flex-shrink: 0;
    }
    .unit-icon-box.tec { background: rgba(0, 163, 224, 0.12); color: #00a3e0; border: 1px solid rgba(0, 163, 224, 0.25); }
    .unit-icon-box.print { background: rgba(245, 168, 0, 0.12); color: #f5a800; border: 1px solid rgba(245, 168, 0, 0.25); }
    .unit-icon-box.academy { background: rgba(16, 185, 129, 0.12); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.25); }
    .unit-icon-box.capital { background: rgba(147, 51, 234, 0.12); color: #a855f7; border: 1px solid rgba(147, 51, 234, 0.25); }

    .unit-name-wrap h3 {
      font-family: var(--font-heading);
      font-size: 1.05rem;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
    }
    .unit-tag {
      font-size: 0.7rem;
      font-weight: 600;
      color: var(--text-dim);
    }
    .unit-card p {
      font-size: 0.835rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 1024px) {
      .admin-login-layout {
        grid-template-columns: 1fr;
      }
      .auth-col {
        border-right: none;
        border-bottom: 1px solid var(--border-subtle);
        padding: 2.5rem 1.75rem;
      }
      .showcase-col {
        padding: 3rem 1.75rem;
      }
      .units-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="admin-login-layout">
    
    <!-- ========================================== -->
    <!-- COLUNA ESQUERDA: AUTENTICA\xC7\xC3O ADMINISTRATIVA -->
    <!-- ========================================== -->
    <aside class="auth-col">
      <div>
        <!-- Barra Superior: Voltar ao Site & Alternador de Tema -->
        <div class="auth-header-bar">
          <a href="/" class="back-link" title="Voltar \xE0 p\xE1gina inicial">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Voltar ao site</span>
          </a>

          <button type="button" class="theme-toggle-btn" onclick="toggleRachiTheme()" aria-label="Alternar Tema Claro/Escuro" title="Alternar tema">
            <svg class="icon-sun" width="16" height="16" fill="none" stroke="#f5a800" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
            <svg class="icon-moon" width="16" height="16" fill="none" stroke="#0050f0" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            <span id="theme-toggle-label">Modo Claro</span>
          </button>
        </div>

        <!-- Marca -->
        <div class="brand-wrap">
          <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-dark.png'" alt="RACHI" class="brand-logo-img logo-for-light">
          <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'" alt="RACHI" class="brand-logo-img logo-for-dark">
        </div>

        <h1 class="auth-title">Painel Administrativo</h1>
        <p class="auth-desc">Introduza as suas credenciais para aceder ao sistema corporativo.</p>

        <!-- FORMUL\xC1RIO DE LOGIN -->
        <form id="admin-login-form" method="POST" action="/login" onsubmit="handleAdminLogin(event)">
          <div class="form-group">
            <label for="login-email" class="form-label">E-mail</label>
            <div class="input-wrap">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
              <input type="email" id="login-email" name="email" class="form-control" required autocomplete="username" placeholder="admin@rachi.ao" autofocus>
            </div>
          </div>

          <div class="form-group">
            <label for="login-password" class="form-label">Palavra-passe</label>
            <div class="input-wrap">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              <input type="password" id="login-password" name="password" class="form-control" required autocomplete="current-password" placeholder="Palavra-passe">
              <button type="button" class="toggle-pass-btn" onclick="togglePassVisibility('login-password', this)" aria-label="Mostrar ou ocultar palavra-passe">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
          </div>

          <div class="form-extras">
            <label class="remember-wrap">
              <input type="checkbox" name="remember" checked>
              <span>Manter conectado</span>
            </label>
            <a href="#" class="forgot-link" onclick="handleForgotPassword(event)">Recuperar acesso</a>
          </div>

          <button type="submit" id="btn-login-submit" class="btn-submit">
            <span class="spinner" id="login-spinner"></span>
            <span class="btn-text">Entrar</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>

          <div id="login-feedback" class="feedback-msg" role="alert"></div>
        </form>
      </div>

      <!-- Rodap\xE9 da Barra Esquerda -->
      <footer class="auth-footer">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        <span>Sess\xE3o Encriptada TLS 1.3 &bull; Cloudflare Hyperdrive</span>
      </footer>
    </aside>

    <!-- ======================================================== -->
    <!-- COLUNA DIREITA: INFORMA\xC7\xD5ES DO PROJETO RACHI             -->
    <!-- ======================================================== -->
    <main class="showcase-col">
      <div>
        <!-- Cabe\xE7alho do Showcase -->
        <header class="showcase-header">
          <h2 class="showcase-heading">
            Tecnologia, Ind\xFAstria Gr\xE1fica, Forma\xE7\xE3o e <span>Capital Humano</span>
          </h2>
          <p class="showcase-lead">
            A <strong>RACHI \u2014 Solu\xE7\xF5es Inteligentes Lda.</strong> \xE9 uma estrutura empresarial angolana focada em inova\xE7\xE3o, efici\xEAncia operacional e capacita\xE7\xE3o de alto n\xEDvel, integrando quatro unidades de excel\xEAncia para transformar organiza\xE7\xF5es.
          </p>
        </header>

        <!-- As 4 Unidades de Neg\xF3cio -->
        <div class="units-section-title">
          <span>Unidades de Neg\xF3cio do Projeto RACHI</span>
        </div>

        <div class="units-grid">
          <!-- UNIDADE 1: TEC -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box tec">\u{1F4BB}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI TEC</h3>
                  <span class="unit-tag">Tecnologia & Infraestrutura</span>
                </div>
              </div>
              <p>Solu\xE7\xF5es completas de TI: desenvolvimento de software, infraestruturas cloud de alta disponibilidade, ciberseguran\xE7a, redes estruturadas e suporte corporativo gerido.</p>
            </div>
          </article>

          <!-- UNIDADE 2: PRINT -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box print">\u{1F5A8}\uFE0F</div>
                <div class="unit-name-wrap">
                  <h3>RACHI PRINT</h3>
                  <span class="unit-tag">Ind\xFAstria Gr\xE1fica & Merchandising</span>
                </div>
              </div>
              <p>Comunica\xE7\xE3o visual e produ\xE7\xE3o gr\xE1fica profissional: impress\xE3o digital e offset de alta precis\xE3o, grandes formatos, sinal\xE9tica, brindes personalizados e branding corporativo.</p>
            </div>
          </article>

          <!-- UNIDADE 3: ACADEMY -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box academy">\u{1F393}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI ACADEMY</h3>
                  <span class="unit-tag">Forma\xE7\xE3o Profissional & LMS</span>
                </div>
              </div>
              <p>Centro de excel\xEAncia em capacita\xE7\xE3o executiva e tecnol\xF3gica: cursos avan\xE7ados, plataforma LMS interativa, emiss\xE3o de certificados e programas in-company sob medida.</p>
            </div>
          </article>

          <!-- UNIDADE 4: HUMAN CAPITAL -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box capital">\u{1F465}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI HUMAN CAPITAL</h3>
                  <span class="unit-tag">Gest\xE3o Estrat\xE9gica de Talentos</span>
                </div>
              </div>
              <p>Recrutamento executivo especializado, outsourcing de especialistas em tecnologia, avalia\xE7\xE3o de compet\xEAncias e consultoria de recursos humanos para empresas.</p>
            </div>
          </article>
        </div>
      </div>
    </main>

  </div>

  <!-- Scripts de Interatividade e Autentica\xE7\xE3o -->
  <script>
    (function updateThemeButtonLabel() {
      var isDark = document.documentElement.classList.contains('dark');
      var label = document.getElementById('theme-toggle-label');
      if (label) label.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';
    })();

    function togglePassVisibility(inputId, btn) {
      var input = document.getElementById(inputId);
      if (!input) return;
      var isPass = input.type === 'password';
      input.type = isPass ? 'text' : 'password';
      btn.setAttribute('aria-label', isPass ? 'Ocultar palavra-passe' : 'Mostrar palavra-passe');
      btn.innerHTML = isPass 
        ? '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>'
        : '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
    }

    function handleForgotPassword(e) {
      e.preventDefault();
      if (window.RachiToast) {
        RachiToast.info('Para redefini\xE7\xE3o de palavra-passe corporativa, contacte a equipa de TI: it@rachi.co.ao');
      } else {
        alert('Para redefini\xE7\xE3o de palavra-passe corporativa, contacte a equipa de TI: it@rachi.co.ao');
      }
    }

    async function handleAdminLogin(e) {
      e.preventDefault();
      var btn = document.getElementById('btn-login-submit');
      var btnText = btn.querySelector('.btn-text');
      var spinner = document.getElementById('login-spinner');
      var feedback = document.getElementById('login-feedback');
      
      var email = document.getElementById('login-email').value.trim();
      var password = document.getElementById('login-password').value;

      if (!email || !password) {
        if (window.RachiToast) RachiToast.error('Por favor, informe o e-mail e a palavra-passe.');
        return;
      }

      btn.disabled = true;
      btnText.textContent = 'A autenticar...';
      spinner.style.display = 'inline-block';
      feedback.style.display = 'none';
      feedback.textContent = '';

      try {
        var response = await fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email: email, password: password }),
          credentials: 'same-origin'
        });

        var data = await response.json().catch(function() {
          return { success: false, message: 'Resposta inv\xE1lida do servidor.' };
        });

        if (!response.ok || !data.success) {
          var msg = data.message || 'Credenciais incorretas ou utilizador inativo.';
          if (window.RachiToast) RachiToast.error(msg);
          feedback.className = 'feedback-msg error';
          feedback.textContent = msg;
          feedback.style.display = 'block';
          return;
        }

        if (window.RachiToast) RachiToast.success('Autentica\xE7\xE3o bem-sucedida! A redirecionar...');
        
        if (window.RachiSession) {
          try { await window.RachiSession.session(); } catch(err) {}
        }

        var role = data.user ? data.user.role_slug : null;
        var isAdmin = ['admin', 'super_admin'].indexOf(role) !== -1;
        var urlParams = new URLSearchParams(window.location.search);
        var redirectParam = urlParams.get('redirect');

        setTimeout(function() {
          if (redirectParam) {
            window.location.href = redirectParam;
          } else if (isAdmin) {
            window.location.href = '/admin-dashboard';
          } else if (data.redirect) {
            window.location.href = data.redirect;
          } else {
            window.location.href = '/portal';
          }
        }, 350);

      } catch (err) {
        var msg = err.message || 'Falha na liga\xE7\xE3o com o servidor.';
        if (window.RachiToast) RachiToast.error(msg);
        feedback.className = 'feedback-msg error';
        feedback.textContent = msg;
        feedback.style.display = 'block';
      } finally {
        btn.disabled = false;
        btnText.textContent = 'Entrar';
        spinner.style.display = 'none';
      }
    }
  <\/script>
</body>
</html>`;
}
__name(loginPage, "loginPage");
function portalPage() {
  return shell("Portal", `<div class="portal"><aside><p class="eyebrow">\xC1REA RESERVADA</p><h2 id="user-name">Minha conta</h2><nav id="portal-nav"><button data-tab="requests">Solicita\xE7\xF5es</button><button data-tab="orders">Pedidos</button><button data-tab="quotes">Or\xE7amentos</button><button data-tab="courses">Meus cursos</button><button data-tab="password">Palavra-passe</button></nav><form data-api="/logout" data-redirect="/"><button class="secondary">Sair</button></form></aside><section><p class="eyebrow">RACHI / PORTAL</p><h1 id="section-title">Solicita\xE7\xF5es</h1><div id="portal-content" aria-live="polite">Carregando\u2026</div></section></div>`);
}
__name(portalPage, "portalPage");
function catalogPage(kind, slug = "") {
  return shell(kind === "courses" ? "Academy" : "Loja", `<p class="eyebrow">${kind === "courses" ? "RACHI ACADEMY" : "RACHI STORE"}</p><h1>${kind === "courses" ? "Aprenda. Cres\xE7a. Transforme." : "Tecnologia para o seu dia a dia"}</h1><div id="catalog" data-kind="${kind}" data-slug="${slug.replace(/[^a-zA-Z0-9_-]/g, "")}">Carregando\u2026</div>`);
}
__name(catalogPage, "catalogPage");
function cartPage() {
  return shell("Carrinho", `<p class="eyebrow">RACHI STORE</p><h1>Seu carrinho</h1><div id="cart">Carregando\u2026</div>`);
}
__name(cartPage, "cartPage");

// worker/index.ts
var app = new Hono2();
app.use("*", bodyLimit({ maxSize: 26 * 1024 * 1024, onError: /* @__PURE__ */ __name((c) => c.json({ success: false, message: "Pedido excede 26 MB." }, 413), "onError") }));
app.use("*", async (c, next) => {
  c.header("X-Content-Type-Options", "nosniff");
  c.header("Referrer-Policy", "strict-origin-when-cross-origin");
  c.header("X-Frame-Options", "SAMEORIGIN");
  c.header("Cache-Control", "private, no-store");
  if (!["GET", "HEAD", "OPTIONS"].includes(c.req.method)) {
    const origin = c.req.header("origin");
    if (origin !== new URL(c.req.url).origin || c.req.header("sec-fetch-site") === "cross-site") return fail(403, "Origem do pedido n\xE3o autorizada.");
  }
  const db = new DB(c.env.HYPERDRIVE.connectionString);
  c.set("db", db);
  try {
    await db.client.connect();
    await authenticate(c);
    await next();
  } finally {
    await db.client.end().catch(() => {
    });
  }
});
app.route("/", auth);
app.route("/", catalog);
app.route("/", requests);
app.route("/", management);
app.route("/", commerce);
app.get("/health/database", async (c) => {
  await c.get("db").query("SELECT 1");
  return c.json({ status: "ok" });
});
app.get("/portal", (c) => c.get("user") ? c.html(portalPage()) : c.redirect("/login"));
app.get("/_session-page/:page", async (c) => {
  const u = c.get("user"), page = c.req.param("page");
  if (!["admin-dashboard", "aluno-dashboard"].includes(page)) return c.notFound();
  if (!u) return c.redirect("/login");
  if (page === "admin-dashboard" ? !admin(u) : !admin(u) && !student(u)) return c.redirect("/academy/cursos");
  const asset = await c.env.ASSETS.fetch(new Request(new URL("/pages/" + page + ".html", c.req.url)));
  return new Response(asset.body, { status: asset.status, headers: { "Content-Type": "text/html; charset=utf-8", "Cache-Control": "private, no-store" } });
});
app.onError((error, c) => {
  if (error instanceof HTTPException) return c.json({ success: false, message: error.message }, error.status);
  const code = error?.code;
  if (code === "23505") return c.json({ success: false, message: "Este registo j\xE1 existe." }, 409);
  if (["23503", "23514", "22P02", "22007", "22008"].includes(code)) return c.json({ success: false, message: "Dados inv\xE1lidos ou relacionados a um registo inexistente." }, 422);
  console.error("Worker request failed", { path: c.req.path, code: code ?? error.name });
  return c.json({ success: false, message: "Servi\xE7o temporariamente indispon\xEDvel." }, 503);
});
app.notFound((c) => c.json({ success: false, message: "P\xE1gina n\xE3o encontrada." }, 404));
var pages = { "/": "home", "/sobre": "about", "/sobre-nos": "about", "/o-que-fazemos": "what-we-do", "/parceiros": "partners", "/depoimentos": "testimonials", "/etica": "ethics", "/contacto": "contact", "/contato": "contact", "/tec": "tec", "/print": "print", "/academy": "academy", "/capital": "capital", "/academy/login": "academy-login", "/academy-login": "academy-login", "/academy/matricula": "academy-login", "/aluno-dashboard": "aluno-dashboard", "/dashboard-aluno": "aluno-dashboard", "/aluno": "aluno-dashboard", "/academy/dashboard": "aluno-dashboard", "/admin-dashboard": "admin-dashboard", "/admin/dashboard": "admin-dashboard", "/admin-dashboard.html": "admin-dashboard", "/loja": "loja", "/loja.html": "loja" };
var portals = { "/cliente/dashboard": "requests", "/funcionario/dashboard": "requests", "/cliente/cursos": "courses", "/cliente/pedidos": "orders", "/funcionario/pedidos": "orders", "/cliente/orcamentos": "quotes", "/admin/utilizadores": "usuarios", "/admin/funcionarios": "usuarios", "/admin/clientes": "clientes", "/admin/produtos": "loja-produtos", "/admin/servicos": "grafica-produtos", "/admin/cursos": "academy-cursos", "/admin/pedidos": "loja-pedidos", "/admin/solicitacoes": "requests", "/admin/relatorios": "relatorios", "/funcionario/estoque": "stock", "/cliente/solicitacoes": "requests", "/cliente/solicitacoes/nova": "requests", "/funcionario/solicitacoes": "requests" };
function html(value) {
  return new Response(value, { headers: { "Content-Type": "text/html; charset=utf-8", "Cache-Control": "no-store", "X-Content-Type-Options": "nosniff", "X-Frame-Options": "SAMEORIGIN" } });
}
__name(html, "html");
var index_default = {
  async fetch(request, env, ctx) {
    const url = new URL(request.url), path = url.pathname.replace(/\/$/, "") || "/", get = ["GET", "HEAD"].includes(request.method);
    if (get) {
      if (["/toast.js", "/toast.css"].includes(path)) return env.ASSETS.fetch(request);
      if (path === "/up") return Response.json({ status: "ok", runtime: "cloudflare-worker" });
      if (["admin-dashboard", "aluno-dashboard"].includes(pages[path])) {
        url.pathname = "/_session-page/" + pages[path];
        return app.fetch(new Request(url, request), env, ctx);
      }
      if (pages[path]) return env.ASSETS.fetch(new Request(new URL("/pages/" + pages[path] + ".html", url), request));
      if (/^\/(tec|capital)\/servicos\/[^/]+$/.test(path)) {
        const parts = path.split("/");
        return env.ASSETS.fetch(new Request(new URL("/pages/" + parts[1] + "-service-" + parts[3] + ".html", url), request));
      }
      if (portals[path]) return Response.redirect(new URL((path.startsWith("/admin") ? "/admin-dashboard#" : "/portal#") + portals[path], url).toString(), 302);
      if (path === "/login") return html(loginPage());
      if (path === "/registro") return html(loginPage(true));
      if (path.startsWith("/loja/")) return Response.redirect(new URL("/loja", url).toString(), 302);
      if (path === "/academy/cursos") return html(catalogPage("courses"));
      if (path === "/carrinho" || path === "/checkout") return html(cartPage());
      if (/^\/(tec|print|capital)\/(servicos|produtos)$/.test(path)) return html(catalogPage(path.endsWith("produtos") ? "products" : "services"));
      if (/^\/solucoes\/(tec|print|academy|capital)$/.test(path)) return Response.redirect(new URL("/" + path.split("/")[2], url).toString(), 302);
      if (/^\/(cliente|funcionario)\/solicitacoes\/\d+$/.test(path) || /^\/cliente\/pedidos\/\d+$/.test(path)) return Response.redirect(new URL("/portal#" + (path.includes("pedidos") ? "orders" : "requests"), url).toString(), 302);
      if (/^\/(images|css|build|libs)\//.test(path) || ["/auth-session.js", "/worker.css", "/worker-marketing.css", "/worker-ui.js", "/worker-public.js", "/favicon.ico", "/robots.txt"].includes(path)) return env.ASSETS.fetch(request);
    }
    const aliases = { "/cliente/solicitacoes": "/solicitacoes/nova", "/admin/solicitacoes/conversas": "/solicitacoes/conversas" };
    let rewritten = aliases[path] ?? path;
    rewritten = rewritten.replace(/^\/(cliente|funcionario|admin)\/solicitacoes\/(\d+)\/mensage(?:m|ns)$/, "/solicitacoes/$2/mensagem").replace(/^\/(funcionario|admin)\/solicitacoes\/(\d+)\/status$/, "/api/requests/$2/status").replace(/^\/funcionario\/solicitacoes\/(\d+)\/assumir$/, "/api/requests/$1/assign");
    if (rewritten !== url.pathname) {
      url.pathname = rewritten;
      request = new Request(url, request);
    }
    return app.fetch(request, env, ctx);
  }
};
export {
  app,
  index_default as default
};
//# sourceMappingURL=index.js.map
