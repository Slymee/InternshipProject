@extends('userend.layouts.index-template')

@section('vite-resource')
    @vite(['resources/css/nav-bar.css', 'resources/css/create-product.css'])
@endsection

@section('page-title')
    Brand - Create an Ad
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@vite(['/resources/css/multi-select-tag.css'])
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css"> --}}
    <section>
        <div class="form-container">
            <span>Create an Ad</span>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="product_title" class="form-label">Product Title</label>
                    <input type="text" class="form-control" name="product_title" id="exampleFormControlInput1" placeholder="Enter Product Title">
                  </div>
                  <div class="mb-3">
                    <label for="product_description" class="form-label">Product Description</label>
                    <textarea class="form-control" name="product_description" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Product Description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="product_price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" name="product_price" id="exampleFormControlInput1" placeholder="Enter Product Price">
                  </div>
                  <div class="mb-3">
                    <label for="product_tag" class="form-label">Product Tag</label>
                    <input type="text" class="form-control" name="product_tag" id="exampleFormControlInput1" placeholder="Enter Product Tag">
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Product Image</label>
                    <input class="form-control" type="file" id="formFile">
                  </div>
                  <div class="mb-3">
                    <select class="form-select" size="3" aria-label="size 3 select example" id="categories">
                        <option selected>Select Categories</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                  </div>
                  <input class="btn btn-primary" type="submit" value="Create Ad">
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script> --}}

    
    <script>
      function MultiSelectTag(e, t = { shadow: !1, rounded: !0 }) {
    var n = null,
      l = null,
      d = null,
      a = null,
      s = null,
      i = null,
      o = null,
      r = null,
      c = null,
      u = null,
      p = null,
      v = null,
      m = t.tagColor || {},
      h = new DOMParser();
    function f(e = null) {
      for (var t of ((v.innerHTML = ""), l))
        if (t.selected) !w(t.value) && g(t);
        else {
          const n = document.createElement("li");
          (n.innerHTML = t.label),
            (n.dataset.value = t.value),
            e && t.label.toLowerCase().startsWith(e.toLowerCase())
              ? v.appendChild(n)
              : e || v.appendChild(n);
        }
    }
    function g(e) {
      const t = document.createElement("div");
      t.classList.add("item-container"),
        (t.style.color = m.textColor || "#2c7a7b"),
        (t.style.borderColor = m.borderColor || "#81e6d9"),
        (t.style.background = m.bgColor || "#e6fffa");
      const n = document.createElement("div");
      n.classList.add("item-label"),
        (n.style.color = m.textColor || "#2c7a7b"),
        (n.innerHTML = e.label),
        (n.dataset.value = e.value);
      const d = new DOMParser().parseFromString(
        '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="item-close-svg">\n                <line x1="18" y1="6" x2="6" y2="18"></line>\n                <line x1="6" y1="6" x2="18" y2="18"></line>\n                </svg>',
        "image/svg+xml",
      ).documentElement;
      d.addEventListener("click", (t) => {
        (l.find((t) => t.value == e.value).selected = !1), C(e.value), f(), E();
      }),
        t.appendChild(n),
        t.appendChild(d),
        o.append(t);
    }
    function L() {
      for (var e of v.children)
        e.addEventListener("click", (e) => {
          (l.find((t) => t.value == e.target.dataset.value).selected = !0),
            (c.value = null),
            f(),
            E(),
            c.focus();
        });
    }
    function w(e) {
      for (var t of o.children)
        if (
          !t.classList.contains("input-body") &&
          t.firstChild.dataset.value == e
        )
          return !0;
      return !1;
    }
    function C(e) {
      for (var t of o.children)
        t.classList.contains("input-body") ||
          t.firstChild.dataset.value != e ||
          o.removeChild(t);
    }
    function E(e = !0) {
      selected_values = [];
      for (var d = 0; d < l.length; d++)
        (n.options[d].selected = l[d].selected),
          l[d].selected &&
            selected_values.push({ label: l[d].label, value: l[d].value });
      e && t.hasOwnProperty("onChange") && t.onChange(selected_values);
    }
    (n = document.getElementById(e)),
      (function () {
        (l = [...n.options].map((e) => ({
          value: e.value,
          label: e.label,
          selected: e.selected,
        }))),
          n.classList.add("hidden"),
          (d = document.createElement("div")).classList.add("mult-select-tag"),
          (a = document.createElement("div")).classList.add("wrapper"),
          (i = document.createElement("div")).classList.add("body"),
          t.shadow && i.classList.add("shadow"),
          t.rounded && i.classList.add("rounded"),
          (o = document.createElement("div")).classList.add("input-container"),
          (c = document.createElement("input")).classList.add("input"),
          (c.placeholder = `${t.placeholder || "Search..."}`),
          (r = document.createElement("inputBody")).classList.add("input-body"),
          r.append(c),
          i.append(o),
          (s = document.createElement("div")).classList.add("btn-container"),
          ((u = document.createElement("button")).type = "button"),
          s.append(u);
        const e = h.parseFromString(
          '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n            <polyline points="18 15 12 21 6 15"></polyline></svg>',
          "image/svg+xml",
        ).documentElement;
        u.append(e),
          i.append(s),
          a.append(i),
          (p = document.createElement("div")).classList.add("drawer", "hidden"),
          t.shadow && p.classList.add("shadow"),
          t.rounded && p.classList.add("rounded"),
          p.append(r),
          (v = document.createElement("ul")),
          p.appendChild(v),
          d.appendChild(a),
          d.appendChild(p),
          n.nextSibling
            ? n.parentNode.insertBefore(d, n.nextSibling)
            : n.parentNode.appendChild(d);
      })(),
      f(),
      L(),
      E(!1),
      u.addEventListener("click", () => {
        p.classList.contains("hidden") &&
          (f(), L(), p.classList.remove("hidden"), c.focus());
      }),
      c.addEventListener("keyup", (e) => {
        f(e.target.value), L();
      }),
      c.addEventListener("keydown", (e) => {
        if ("Backspace" === e.key && !e.target.value && o.childElementCount > 1) {
          const e = i.children[o.childElementCount - 2].firstChild;
          (l.find((t) => t.value == e.dataset.value).selected = !1),
            C(e.dataset.value),
            E();
        }
      }),
      window.addEventListener("click", (e) => {
        d.contains(e.target) || p.classList.add("hidden");
      });
  }
    </script>
    <script>
        new MultiSelectTag('categories')  // id
    </script>
@endsection