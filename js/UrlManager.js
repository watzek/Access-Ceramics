/*
  Changes the url to match front-end JS state changes

  values to worry about:
    limit -
    order (not implemented)
    view
    page
*/

export default class UrlManager
{
  constructor(get_args)
  {
    this.args = get_args;
    this.base = '?';
    this.params = {'limit':0,'page':0,'view':0};

    // let i = 0;
    // for (var key in this.args)
    // {
    //   if (i > 0) this.base += '&';
    //   else i++;
    //   this.base += key + '=' +this.args[key];
    // }
    console.log(this.base);
  }

  update_params(obj)
  {
      for(var key in this.params)
      {
        if (obj[key] === undefined)
        {
          obj[key] = this.params[key];
        }
      }
      this.params = obj;
      return obj;
  }

  build_url(obj)
  {
    obj = this.update_params(obj);
    console.log(obj);

    let newrl = this.base;
    let i = 0;
    for (var key in obj)
      if (obj[key] != 0)
      {
        newrl += key + '=' + obj[key];
        if (i > 0) newrl += '&';
        else i++;
      }

    return newrl;
  }

  set_url(obj)
  {
    return;
    let newrl = this.build_url(obj);
    window.history.replaceState("",document.title,newrl);
  }
}
