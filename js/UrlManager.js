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
    this.current_page = get_args['state'];

    if (this.current_page === "view") this.current_page = 'collection';
    this.id = get_args['id'];
    if (this.id === undefined) this.id = "";
    else
    {
      if(this.current_page === 'artist')
      {
        this.current_page = 'artists';
        this.id = get_args['artist_id'];
      }
      this.id+='/';
    }
  }

  update_params(obj)
  {
      let f = false;
      for(var key in this.params)
      {
        if (obj[key] === undefined)

          obj[key] = this.params[key];
        else if(obj[key] !== this.params[key])
        {
          f = true;
          console.log(key, this.params[key], obj[key]);
        }
      }
      this.params = obj;
      return f ? obj : false;
  }

  build_url(obj)
  {
    obj = this.update_params(obj);
    if (obj === false) return obj;

    let newrl = '?';

    let flag = false;

    if (obj['page'] !== undefined)
    {
      newrl += 'page='+obj['page'];
      flag = true;
    }

    if(obj['view'] !== undefined)
    {
      newrl += (flag?'&':'') + 'view='+obj['view'];
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
    //return;
    let newrl = this.build_url(obj);
    if (newrl === false) return;
    console.log(this.current_page, newrl);
    window.history.replaceState("","", newrl);
  }
}
