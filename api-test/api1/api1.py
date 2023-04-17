import numpy as np
import pandas as pd
import pickle 
import csv
import json
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import accuracy_score

df = pd.read_csv('students_placement.csv')
df.sample(5)
X = df.drop(columns=['placed'])
y = df['placed']

X_train,X_test,y_train,y_test = train_test_split(X,y,test_size=0.2,random_state=2)

#train the model

rf = RandomForestClassifier()
knn= KNeighborsClassifier()
rf.fit(X_train,y_train)
y_pred = rf.predict(X_test)
print(accuracy_score(y_test,y_pred))

knn.fit(X_train,y_train)
y_pred = knn.predict(X_test)
print(accuracy_score(y_test,y_pred))

#save the model in pickle format

pickle.dump(knn,open('model.pkl','wb'))
print(knn)

#Flask Api to get and return values

from flask import Flask,request,jsonify
import numpy as np
import pickle
model = pickle.load(open('model.pkl','rb'))
app = Flask(__name__)
@app.route('/')
def index():
    return "Hello world!"
@app.route('/predict',methods=['POST'])
def predict():
    cgpa = request.form.get('cgpa')
    iq = request.form.get('iq')
    profile_score = request.form.get('profile_score')
    input_query = np.array([[cgpa,iq,profile_score]])
    result = model.predict(input_query)[0]
    return jsonify({'placement':str(result)})

@app.route('/display')


def display():
    csvFilePath="students_placement.csv"
    jsonFilePath="api1.json"

    jsonArray = []
      
    #read csv file
    with open(csvFilePath, encoding='utf-8') as csvf: 
        #load csv file data using csv library's dictionary reader
        csvReader = csv.DictReader(csvf) 

        #convert each csv row into python dict
        for row in csvReader: 
            #add this python dict to json array
            jsonArray.append(row)
  
    #convert python jsonArray to JSON String and write to file
    with open(jsonFilePath, 'w', encoding='utf-8') as jsonf: 
        jsonString = json.dumps(jsonArray, indent=4)
        jsonf.write(jsonString)
          
        with open(jsonFilePath) as f:
            json_data = json.load(f)
    return json_data

if __name__ == '__main__':
    app.run(debug=True)
    