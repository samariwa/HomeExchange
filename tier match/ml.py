import json
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.preprocessing import StandardScaler
from sklearn.model_selection import train_test_split
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import classification_report, confusion_matrix

house_features = [0,0,0,0,1,1,0,0,0,0,0,0,0,0,1]
data = pd.read_csv('/Users/Mariwa/.bitnami/stackman/machines/xampp/volumes/root/htdocs/HomeExchange/tier match/tier_dataset.csv')
X = data.iloc[:,:-1].values
Y = data.iloc[:, 15].values

X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size = 0.9)

scaler = StandardScaler()
scaler.fit(X_train)
X_train = scaler.transform(X_train)
X_test = scaler.transform(X_test)

classifier = KNeighborsClassifier(n_neighbors=5)
classifier.fit(X_train,Y_train)

y_pred = classifier.predict(X_test)

check_value = np.array(house_features)

tier_prediction = classifier.predict([check_value])
#json_obj = json.dumps(tier_prediction)
tier = tier_prediction[0]
print(tier)
