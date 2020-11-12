#importacion desde consola with "pip install flask"
from flask import Flask, redirect, render_template, request, url_for
#importacion desde consola with "pip install flaskext-mysql"
from flaskext.mysql import MySQL

#el programa aún presenta errores de extensión flask para conexión de BBDD
app=Flask(__name__)

mysql=MySQL()
app.config["MYSQL_DATABASE_USER"]='root'
app.config["MYSQL_DATABASE_PASSWORD"]=''
app.config["MYSQL_DATABASE_DB"]='bbdd' #nombre de la BBDD
app.config["MYSQL_DATABASE_HOST"]='localhost'
mysql.init_app(app)

@app.route("src/pages/login.html", methods=['GET', 'POST'])
def login():
    if request.method=='POST':
        usuario=request.form['usuario']
        contrasena=request.form['contrasena']
        con=mysql.connect()
        cur=con.cursor()
        cur.execute("SELECT * FROM 'registro' WHERE 'usuario' = "+usuario+"' and 'contrasena' = '"+contrasena+"'")
        data=cur.fetchone()
        if data[2]==usuario and data[3]==contrasena:
            return redirect(url_for('nosotros', data=data[0]))
    else:
        error="invalid"
        return render_template("login.html")

@app.route("src/pages/registro.html", methods=['GET', 'POST'])
def registro():
    if request.method=='POST':
        correo=request.form['correo'] #primer campo
        usuario=request.form['usuario'] #segundo campo
        contrasena=request.form['contrasena'] #tercer campo
        con=mysql.connect()
        cur=con.cursor()
        cur.execute("INSERT INTO 'registro' ('correo', 'usuario', 'contrasena') VALUES (%s, %s, %s)", (correo, usuario, contrasena))
        con.commit()
        return redirect('login.html')
    else:
        return render_template("registro.html")

if(__name__=='__main__'):
    app.run(debug=True)
