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
    this.params = {'limit':0,'page':0,'view':0};

    // let i = 0;
    // for (var key in this.args)
    // {
    //   if (i > 0) this.base += '&';
    //   else i++;
    //   this.base += key + '=' +this.args[key];
    // }
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

    let newrl = '';
    let flag = false;

    if (obj['page'] !== undefined)
      newrl += ''+obj['page']+'/';

    newrl+='?';

    if(obj['view'] !== undefined)
    {
      newrl += 'view='+obj['view'];
      flag = true;
    }
    if(obj['limit'] !== undefined)
    {
      newrl += (flag?'&':'') + 'limit='+obj['limit'];
    }

    return newrl;
  }

  set_url(obj)
  {
    return;
    let newrl = this.build_url(obj);
    //console.log(newrl);
    window.history.replaceState("",document.title,newrl);
  }
}
